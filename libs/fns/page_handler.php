<?php
require_once('operator.php');
class PageHandler extends Operator
{
    public $page_name;
    public $active_template;

    /*** PAGE RENDERING *******************************************************************/

    # Disables mouse right-click if set to 0
    public function right_click_switch($status = 1)
    {
        switch ($status)
        {
            case 0:
                $right_click_status = 'oncontextmenu="return false"';
                break;
            case 1:
                $right_click_status = '';
                break;
            default:
                $right_click_status = '';
                break;
        }

        return $right_click_status;
    }

    # Retrieves a scripts' output result
    public function get_script_output($path, $print = FALSE)
    {
        ob_start();

        if( is_readable($path) && $path )
        {
            include $path;
        }
        else
        {
            return FALSE;
            //echo '<h2 class="error">CONTENT FILE IS UNREADABLE OR DOESN\'T EXIST</h2>';
        }

        if( $print == FALSE )
            return ob_get_clean();
        else
            echo ob_get_clean();
    }

    # Retrieves content from within one of the files stored within the content directory
    public function get_content($depth, $param1, $param2 = '', $param3 = '')
    {
        $config = new Config();
        $templata_content_dir = $config->templata_content_directory;
        $error_page = $templata_content_dir.'/error/index.php';

        if(!empty($param3)) # Checks if all parameters have values
        {
            $path = $param1 . '/' . $param2 . '/' . $param3;
        }
        elseif(!empty($param2))
        {
            $path = $param1 . '/' . $param2;
        }
        elseif(!empty($param1))
        {
            $path = $param1;
        }

        $full_path = $depth.$templata_content_dir.'/'.$path;

        $seek_file_extention = function($extentionless_path)
        {
            $path_with_extention_arr = glob($extentionless_path.'.*');
            $path_with_extention = array();
            foreach($path_with_extention_arr as $pwe)
            {
                if(strpos($pwe, '.html'))
                {
                    $path_with_extention['html'] = $pwe;
                }
                elseif(strpos($pwe, '.php'))
                {
                    $path_with_extention['php'] = $pwe;
                }
                elseif(strpos($pwe, '.txt'))
                {
                    $path_with_extention['txt'] = $pwe;
                }
            }

            if(empty($path_with_extention))
            {
                # redirects to error page if file cant't be found
                //header('Location : '. $this->get_base_url().'error/404');
                return false;
            }
            else
            {
                return array_values($path_with_extention)[0];
            }
        };

        if(file_exists($full_path)) #checks if path is only a directory
        {
            #if condition is true, index file is sought out
            $full_path .= '/index';

            if($seek_file_extention($full_path))
            {
                $full_path = $seek_file_extention($full_path);
            }
            else
            {
                # display error page
                $full_path = $error_page;
            }
        }
        else
        {
            if(file_exists($seek_file_extention($full_path)))
            {
                $full_path = $seek_file_extention($full_path);
            }
            else
            {
                # display error page
                $full_path = $error_page;
            }
        }

        $content = $this->get_script_output($full_path);
        return $content;
    }

    public function set_page_name($page_name)
    {
        $this->page_name = $page_name;
    }

    public function get_page_name()
    {
        return $this->page_name;
    }

    # Placeholder management
    public function placeholder_manager($template, $content, $depth)
    {
        $config = new Config();

        # Order of placeholders is crucial. Eg: By placing body-content at the end of the array,
        # placeholders defined within body-content won't be substituted with their appropriate replacements
        # thus leaving the placeholder as is.

        $all_placeholders = array(
            'templata:app-name' => $config->app_name,
            'template:res' => $depth.'templates/'.$this->active_template,
            'template:css' => $this->unpack_css_files(),
            'page_title' => $this->page_name,
            'templata:right-click' => $this->right_click_switch($config->right_click),
            'body-content' => $content,
            'base-url' => '<base href="'.$this->get_base_url().'"/>',
            'relative' => $depth,
            'favicon' => $depth.'templates/'.$this->active_template.'/images/favicon/favicon.ico',
            'templata:libs' => $depth.$config->templata_libraries,
            'templata:images' => $depth.$config->templata_images_directory,
            'template:images' => $depth.'templates/'.$this->active_template.'/'.'images',
            'templata:jquery' => $this->get_jquery($depth),
            'validation:contact-form' => $depth.'tools/validation/contact-form.php',
            'navi:desktop' => $this->navigation_menu($depth),
            'navi:mobile' => $this->navigation_menu($depth)
        );

        # Replacing all placeholders
        foreach($all_placeholders as $placeholder=>$replacement)
        {
            $template = str_replace('{'.$placeholder.'}', $replacement, $template);
        }

        return $template;
    }

    # This function puts together all the necessary elements required to output an entire page and modifies
    # some of them by replacing predetermined placeholders.
    # It's capable of displaying a page as well but it's main purpose is to sum up page contents reuirted in order
    # to display a page.
    public function generate_page($depth, $body_content = null, $output_mode = 1)
    {
        # Declarations
        $config = new Config();

        # Template override; overrides existing template if user has specified a template on the content source
        if(preg_match_all("/\[(template:.*?)\]/", $body_content, $template_name_matches))
        {
            $body_content = str_replace($template_name_matches[0][0], '', $body_content);
            $active_template = $template_name_matches[1][0];
            $this->active_template = str_replace('template:', '', $active_template);
        }
        else
        {
            $this->active_template = $config->active_template;
        }

        $template_path = APP_ROOT_DIR.'/templates/'.$this->active_template.'/index';

        if(file_exists($template_path.'.html'))
        {
            $template_path .= '.html';
        }
        elseif(file_exists($template_path.'.php'))
        {
            $template_path .= '.php';
        }

        $data = $this->get_script_output($template_path);

        if($this->get_page_name() == null)
        {
            # getting page name from source '[page:page_name]'
            preg_match_all("/\[(page:.*?)\]/", $body_content, $page_name_matches);

            # removing page name placeholder from the source output
            if(!empty($page_name_matches[0][0]))
            {
                $body_content = str_replace($page_name_matches[0][0], '', $body_content);
            }
            # assigning page title
            $page_title = (!empty($page_name_matches[1][0]) ? $page_title = $page_name_matches[1][0] : $page_title = get_current_uri(1));

            # cleaning up page title and assigning it to class variable
            $this->page_name = str_replace('page:', '', $page_title);
        }

        $include = $this->placeholder_manager($data, $body_content, $depth);

        # Allows toleration of hash tag links
        $hash_links = $this->hash_tag_links($include);
        if(is_array($hash_links))
        {
            foreach($hash_links as $key=>$hash_link)
            {
                if(!empty($key))
                {
                    $include = str_replace('href="#'.$key.'"', 'href="'.$hash_link.'"', $include);
                    $include = str_replace('href=\'#'.$key.'\'', 'href=\''.$hash_link.'\'', $include);
                }
                else
                {
                    $include = str_replace('href="#"', 'href="'.$hash_link.'" ', $include);
                    $include = str_replace('href=\'#\'', 'href="'.$hash_link.'" ', $include);
                }
            }
        }

        switch($output_mode)
        {
            case 0:
                echo $include;
                break;

            case 1:
                return $include;
        }
    }

    # Only used for displaying the final output
    public function display_page($relative_path_depth, $body_content)
    {
        $page_output = $this->generate_page($relative_path_depth, $body_content, 1);

        # Display the page.
        echo $page_output;
    }

    /*** END OF PAGE RENDERING ***********/
}