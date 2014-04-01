<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once('operator.php');
class PageHandler extends Operator
{
    /*** PAGE RENDERING *******************************************************************/

    # disables mouse right-click if set to 0
    public function right_click_status($status)
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

    # this get content function will soon be deprecated (hence the _depr suffix)
    public function get_content_depr($depth, $dir, $file_name)
    {
        $config = new Config();
        $content_direcory = $config->templata_content_directory;
        $file_path = $depth.$content_direcory.'/'.$dir.'/'.$file_name;
        $content = file_get_contents($file_path);
        return $content;
    }

    public function get_content($depth, $dir, $file)
    {
        $config = new Config();
        $path = $dir.'/'.$file;
        $templata_content_dir = $config->templata_content_directory;
        $full_path = $depth.$templata_content_dir.'/'.$path;

        if(file_exists($full_path.'.html'))
        {
            $full_path .= '.html';
        }
        elseif(file_exists($full_path.'.php'))
        {
            $full_path .= '.php';
        }
        elseif(file_exists($full_path.'.txt'))
        {
            $full_path .= '.txt';
        }
        else
        {
            $full_path = $templata_content_dir.'/default.php';
        }

        $content = $this->get_script_output($full_path);
        return $content;
    }

    public function output_page($depth, $body_content = null)
    {
        # Declarations
        $config = new Config();
        $app_name = $config->app_name;

        # Template override; overrides existing template if user has specified a template on the content source
        if(preg_match_all("/\[(template:.*?)\]/", $body_content, $template_name_matches))
        {
            $body_content = str_replace($template_name_matches[0][0], '', $body_content);
            $active_template = $template_name_matches[1][0];
            $active_template = str_replace('template:', '', $active_template);
        }
        else
        {
            $active_template = $config->active_template;
        }

        $template_path = APP_ROOT_DIR.'/templates/'.$active_template.'/index';

        if(file_exists($template_path.'.html'))
        {
            $template_path .= '.html';
        }
        elseif(file_exists($template_path.'.php'))
        {
            $template_path .= '.php';
        }

        $template_res = $depth.'templates/'.$active_template;

        $templata_css = $this->unpack_css_files();
        $templata_libs = $depth.$config->templata_libraries;
        $main_images = $depth.$config->templata_images_directory;
        $favicon = $main_images.'/favicon/favicon.ico';

        $contact_form_validation = $depth.'tools/validation/contact-form.php';

//        $file_contents = fopen($template_path, "r");
//
//        while(!feof($file_contents))
//        {
//            $data = fread($file_contents, 500000);
//        }
//        fclose($file_contents);

        $data = $this->get_script_output($template_path);

        # App
        $include = str_replace('{app_name}', $app_name, $data);
        $include = str_replace('{templata_css}', $templata_css, $include);

        # getting page name from source '[page:page_name]'
        preg_match_all("/\[(page:.*?)\]/", $body_content, $page_name_matches);

        # removing page name placeholder from the source output
        $body_content = str_replace($page_name_matches[0][0], '', $body_content);

        # assigning page title
        $page_title = $page_name_matches[1][0];
            # cleaning up page title
        $page_title = str_replace('page:', '', $page_title);
        $include = str_replace('{page_title}', $page_title, $include);

        $include = str_replace('{right_click}', $this->right_click_status($config->right_click), $include);
        $include = str_replace('{body_content}', $body_content, $include);

        # Pathing
        $include = str_replace('{relative}', $depth, $include);
        $include = str_replace('{favicon}', $favicon, $include);
        $include = str_replace('{templata_libs}', $templata_libs, $include);
        $include = str_replace('{template_res}', $template_res, $include);
        $include = str_replace('{templata_images}', $main_images, $include);
        $include = str_replace('{templata_jquery}', $this->get_jquery($depth), $include);
        $include = str_replace('{validation:contact-form}', $contact_form_validation, $include);

        # Navigation
        $include = str_replace('{navigation_menu}', $this->navigation_menu($depth), $include);
        $include = str_replace('{mobile_navigation_menu}', $this->navigation_menu($depth), $include);

        echo $include;
    }

    # Retrieves a scripts' output
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
        }

        if( $print == FALSE )
            return ob_get_clean();
        else
            echo ob_get_clean();
    }
    /*** END OF PAGE RENDERING ***********/
}

?>