<?php
require_once('operator.php');
include_lib('placeholders');
class PageHandler extends Operator
{
    public $page_name;
    public $active_template;

    # Setting and getting page name
    public function set_page_name($page_name) {$this->page_name = $page_name; }
    public function get_page_name() {return $this->page_name; }

    /*** PAGE RENDERING *******************************************************************/
    # Retrieves a scripts' output result
    public function get_script_output($path, $print = FALSE)
    {
        ob_start();

        if( is_readable($path) && $path )
        {
            require_once $path;
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

    public function seek_file_extension($extentionless_path)
    {
        if(file_exists($extentionless_path . '.html')) {$path = $extentionless_path . '.html';}
        elseif(file_exists($extentionless_path . '.php')) {$path = $extentionless_path . '.php';}
        else{return false;}

        return $path;
    }

    # Retrieves content from within one of the files stored within the content directory
    public function get_content($uri)
    {
        $config = new Config();

        # Initial declarations
        $templata_content_dir = $config->templata_content_directory;
        $default_landing = $templata_content_dir . '/' . $config->default_landing_path;
        $error_page = $templata_content_dir.'/error/index.php';

        $plein_uri = str_replace(get_base_url(), '', $uri);

        # Sets the default landing page
        if(empty($default_landing)) {$default_landing .= '/index';}

        if(empty($plein_uri)) {$full_path = $default_landing;}
        else {$full_path = $templata_content_dir . '/' . $plein_uri;}

        # Fishing out the actual content using full_path
        if(!file_exists($full_path))
        {
            if(file_exists($full_path . '.html')) {$full_path .= '.html';}
            elseif(file_exists($full_path . '.php')) {$full_path .= '.php';}
            else{$full_path = $error_page;}
        }
        else
        {
            if(is_dir($full_path))
            {
                if(file_exists($full_path . '/index.html')) {$full_path .= '/index.html';}
                elseif(file_exists($full_path . '/index.php')) {$full_path .= '/index.php';}
                else{$full_path = $error_page;}
            }
        }

        $content = $this->get_script_output($full_path);
        return $content;
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

        # Getting the actual template
        $actual_template = $this->get_script_output($template_path);

        # Determining name of page being currently viewed
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

        # Add CSS or JS script to head
        if(preg_match_all("/\[(head:.*?)\]/", $body_content, $head_matches))
        {
            $i=0;
            foreach($head_matches[1] as $head_match)
            {
                $body_content = str_replace($head_matches[0][$i], '', $body_content);
                $head_files[] = str_replace('head:', '', $head_match);
                $i++;
            }

            $header_files = $this->acquire_header_files($head_files, $this->active_template);
        }
        else
        {
            $header_files = '';
        }

        # Replacing placeholders
        $placeholders = new PlaceholderManager();
        $include = $placeholders->replace_placeholders($actual_template, $body_content, $this->page_name, $header_files, $depth);

        # Allows toleration of hash tag hyperlinks
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