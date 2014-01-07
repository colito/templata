<?php
require_once('../config.php');
class PageHandler
{
    public function link_handler()
    {
        $links_file = APP_ROOT_DIR.'/includes/nav_links.txt';
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
            $colon_position = strpos($link_name, ':');
            $link_names[] = substr($link_name, 1, $colon_position - 1);
        }

        # getting the actual links
        $actual_links = array();
        foreach($clean_lines as $actual_link)
        {
            $colon_position = strpos($actual_link, ':');
            $actual_links[] = substr($actual_link, $colon_position + 1);
        }

        # putting everything together in one array
        $nav_links = array();
        for($i=0; $i<count($link_names); $i++)
        {
            $nav_links[$link_names[$i]] = $actual_links[$i];
        }

        return $nav_links;
    }

    public function set_page_header($page_name)
    {
        # $page_name is already in '../includes/header.php'
        return require_once(main_header);
    }

    public function set_page_footer()
    {
        return require_once(main_footer);
    }
}

$page_handler = new PageHandler();
?>