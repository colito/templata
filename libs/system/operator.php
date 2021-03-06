<?php
require_once(APP_ROOT_DIR.'/'.T_FNS.'functions.php');
require_once('link_handler.php');
abstract class Operator extends LinkHandler
{
    /*** RIGHT CLICK **********************************************************************/
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

    /*** NAVIGATION ***********************************************************************/
    public function navigation_menu($depth = null)
    {
        $x = $this->nav_link_handler();

        if($x == false) {return false;}

        $output = '';
        foreach($x['nav_links'] as $y)
        {
            $output .= '<li><a href="'.$depth.$y['link'].'">'.$y['link_name'].'</a></li>';
        }

        $overall_output = '<ul>';
        $overall_output .= $output;
        $overall_output .='</ul>';

        return $overall_output;
    }
    /*** END OF NAVIGATION ************************/

    /*** SOURCE FILES **************************************************************/
    public function css_files()
    {
        $config = TConfig();
        $links = $config->navigation_links;
        $active_template = $config->active_template;
        $links_file = 'templates/'.$active_template.'/'.$links;

        if(!file_exists($links_file)) {return false;}

        $lines = file($links_file, FILE_IGNORE_NEW_LINES);

        # array clean-up
        $clean_lines = array();
        foreach($lines as $line)
        {
            # checks array for an occupied array index.
            if(!empty($line))
            {
                if(preg_match_all("/\[(css:.*?)\]/", $line, $css_matches)) {$clean_lines[] = $css_matches[1];}
            }
        }

        for($i = 0; $i< count($clean_lines); $i++)
        {
            $css_file = str_replace('css:', '', $clean_lines[$i][0]);
            $css_files[] = $css_file;
        }

        return $css_files;
    }

    public function unpack_css_files()
    {
        $css_files = $this->css_files();

        if(!$css_files)
        {
            return 'No CSS links found';
        }

        $css_links = '';
        foreach($css_files as $css_file)
        {
            $css_links .= '<link rel="stylesheet" href="{template:res}/css/'.$css_file.'" type="text/css" media="screen">' . "\n\n";
        }

        return $css_links;
    }

    public function acquire_header_files($head_files, $active_template)
    {
        $header_resources  = array();

        # CSS Link
        $css_tag_open = '<link rel="stylesheet" href="';
        $css_tag_close = '" type="text/css" media="screen">';

        # JS Link
        $js_tag_open = '<script type="text/javascript" src="';
        $js_tag_close = '"></script>';

        foreach($head_files as $header_file)
        {
            if(strpos($header_file, 'template-css:') !== false)
            {
                $template_css_file = str_replace('template-css:', '', $header_file);
                $template_css_path = 'templates/' . $active_template . '/css/' . $template_css_file;
                $template_html_css_link = $css_tag_open . $template_css_path . $css_tag_close;

                $header_resources[$template_css_path] = $template_html_css_link;
            }
            elseif(strpos($header_file, 'template-js:') !== false)
            {
                $template_js_file = str_replace('template-js:', '', $header_file);
                $template_js_path = 'templates/' . $active_template . '/js/' . $template_js_file;
                $template_html_js_link = $js_tag_open . $template_js_path . $js_tag_close;

                $header_resources[$template_js_path] = $template_html_js_link;
            }
            elseif(strpos($header_file, 'templata-css:') !== false)
            {
                $templata_css_file = str_replace('templata-css:', '', $header_file);
                $templata_css_path =  T_LIBS . '/css/' . $templata_css_file;
                $templata_html_css_link = $css_tag_open . $templata_css_path . $css_tag_close;

                $header_resources[$templata_css_path] = $templata_html_css_link;
            }
            elseif(strpos($header_file, 'templata-js:') !== false)
            {
                $templata_css_file = str_replace('templata-js:', '', $header_file);
                $templata_js_path =  T_LIBS . '/js/' . $templata_css_file;
                $templata_html_js_link = $js_tag_open . $templata_js_path . $js_tag_close;

                $header_resources[$templata_js_path] = $templata_html_js_link;
            }
        }
        return $header_resources;
    }

    public function unpack_header_resources($header_resources)
    {
        $html_head_links = '';
        if(is_array($header_resources))
        {
            if(empty($header_resources)) {return '';}

            foreach($header_resources as $header_resource)
            {
                $html_head_links .= $header_resource . "\n";
            }
        }
        else
        {
            return false;
        }

        return $html_head_links;
    }

    public function get_jquery($depth)
    {
        $config = TConfig();
        $jquery_path = $depth.$config->templata_jquey_path;

        if(glob($jquery_path.'/jquery*'))
        {
            $resource_file = glob($jquery_path.'/jquery*');
            $resource_file['jquery'] = $resource_file[0];
            unset($resource_file[0]);

            $jquery_link = '<script type="text/javascript" src="'.$resource_file['jquery'].'"></script>';

            return $jquery_link;
        }
    }

    public function get_resource($depth, $resource)
    {
        $config = new Config();
        $lib_path = $depth.$config->templata_libraries;
        $libs = glob($lib_path.'/*');

        foreach($libs as $lib)
        {
            $lib_array[basename($lib)] = glob($lib.'/*');
        }

        return $lib_array;
    }
    /*** END OF SOURCE FILES*****************/
}