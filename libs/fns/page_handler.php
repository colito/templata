<?php
//require_once('../config.php');
class PageHandler
{

    public function set_page_header($page_name, $depth)
    {
        # $page_name is already in '../includes/header.php'
        //return require_once('../includes/header.php');
        return require_once(main_header);
        //return 'Another hello!';
    }

    public function set_page_footer()
    {
        return require_once(main_footer);
    }

    # needs to determine depth levels from number of directories not number of overall files
    public function relative_link_path($file_root_path)
    {
        $app_root = APP_ROOT_DIR;
        $relative_path = str_replace($app_root.'/', '', $file_root_path);
        $path_array = explode('/', $relative_path);
        //$depth = count($path_array);

        $depth = '';

        foreach($path_array as $level)
        {
            $level = '../';
            $depth .= $level;
        }

        return $depth;
    }

    # ref: http://css-tricks.com/snippets/php/create-url-slug-from-post-title/
    public function create_slug($string){
        $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($string));
        return $slug;
    }

    public function link_handler()
    {
        $config = new Config();
        $links = $config->navigation_links;
        $links_file = APP_ROOT_DIR.'/'.$links;
        $lines = file($links_file, FILE_IGNORE_NEW_LINES);

        # array clean-up
        $clean_lines = array();
        foreach($lines as $line)
        {
            # checks array for an occupied array index.
            if(!empty($line))
            {
                # checks if the first character of the string is *
                if(substr($line, 0, 1) == '*')
                {
                    $clean_lines[] = substr($line, 0);
                }
            }
        }

        # getting the link names
        $link_names = array();
        foreach($clean_lines as $link_name)
        {
            # fishes out the colon position to determine the reading endpoint.
            $colon_position = strpos($link_name, ':') - 1;
            $link_names[] = substr($link_name, 1, $colon_position);
        }

        # getting the actual links
        $actual_links = array();
        foreach($clean_lines as $actual_link)
        {
            # reads the entire line after the colon
            $colon_position = strpos($actual_link, ':') + 1;
            $actual_links[] = substr($actual_link, $colon_position);
        }

        # putting everything together in one array
        $nav_links = array();
        for($i=0; $i<count($link_names); $i++)
        {
            $nav_links['nav_links'][$i]['link_name'] = $link_names[$i] ;
            $nav_links['nav_links'][$i]['link'] = $actual_links[$i];
        }

        return $nav_links;
    }

    public function navigation_menu($depth = null)
    {
        $x = $this->link_handler();

        echo '<ul>';
        foreach($x['nav_links'] as $y)
        {
            echo '<li><a href=" '.$depth.$y['link'].' ">'.$y['link_name'].'</a></li>';
        }
        echo '</ul>';
    }

    public function navigation_menu2($depth = null)
    {
        $x = $this->link_handler();

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

    public function get_content($depth, $dir, $file_name)
    {
        $config = new Config();
        $content_direcory = $config->templata_content_directory;
        $file_path = $depth.$content_direcory.'/'.$dir.'/'.$file_name;
        $content = file_get_contents($file_path);
        return $content;
    }

    public function main_libraries($depth)
    {
        
    }

    public function get_jquery($depth)
    {
        $config = new Config();
        $jquery_path = $depth.$config->templata_jquey_path;

        $resource_file = glob($jquery_path.'/jquery*');
        $resource_file['jquery'] = $resource_file[0];
        unset($resource_file[0]);

        return $resource_file['jquery'];
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

    public function output_page($depth, $body_content = null)
    {
        //$page_title = $page_name;
        $config = new Config();
        $active_template = $config->active_template;
        $app_name = $config->app_name;

        $template_path = APP_ROOT_DIR.'/template/'.$active_template.'/index.php';
        $template_res = $depth.'template/'.$active_template;
        $templata_libs = $depth.$config->templata_libraries;
        $main_images = $depth.$config->templata_images_directory;
        $favicon = $main_images.'/favicon/favicon.ico';

        $file_contents = fopen($template_path, "r");

        while(!feof($file_contents))
        {
            $data = fread($file_contents, 500000);
        }
        fclose($file_contents);

        # App
        $include = str_replace('{app_name}', $app_name, $data);

        # getting page name from source '[page:page_name]'
        preg_match_all("/\[(page:.*?)\]/", $body_content, $page_name_matches);

        # removing page name placeholder from the source output
        $body_content = str_replace($page_name_matches[0][0], '', $body_content);

        # assigning page title
        $page_title = $page_name_matches[1][0];

        # cleaning up page title
        $page_title = str_replace('page:', '', $page_title);

        $include = str_replace('{page_title}', $page_title, $include);

        # Body
        $include = str_replace('{right_click}', $this->right_click_status($config->right_click), $include);
        $include = str_replace('{body_content}', $body_content, $include);

        # Pathing
        $include = str_replace('{relative}', $depth, $include);
        $include = str_replace('{favicon}', $favicon, $include);
        $include = str_replace('{templata_libs}', $templata_libs, $include);
        $include = str_replace('{template_res}', $template_res, $include);
        $include = str_replace('{templata_images}', $main_images, $include);
        $include = str_replace('{templata_jquery}', $this->get_jquery($depth), $include);

        # Navigation
        $include = str_replace('{navigation_menu}', $this->navigation_menu2($depth), $include);
        $include = str_replace('{mobi_navigation_menu}', $this->navigation_menu2($depth), $include);

        //echo '<img src="'.$main_images.'/theone/1.jpg">';
        echo $include;
    }
}

?>