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
        $links_file = APP_ROOT_DIR.'/config.php';
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

    public function right_click_status($status)
    {
        if($status == 0)
        {
            echo 'oncontextmenu="return false"';
        }
        elseif($status == 1)
        {
            echo '';
        }
    }
}

?>