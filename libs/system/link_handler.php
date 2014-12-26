<?php
abstract class LinkHandler
{
    /*** LINK MANAGEMENT ***********************************************************************/
    # needs to determine depth levels from number of directories not number of overall files
    public function relative_link_path($file_root_path)
    {
        $app_root = APP_ROOT_DIR;

        if($file_root_path == $app_root)
        {
            return;
        }

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
        $config = TConfig();
        $links = 'templates/'.$config->active_template.'/'.$config->navigation_links;

        if(!file_exists($links))
        {
            return false;
        }

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


    /*** LINK EXTRACTION **************************************************/

    # Gets src="" or href="" or any other link depending on the type parameeter. Default = href
    public function extract_links($content, $type = 'href')
    {
        if(preg_match_all('/'.$type.'=\"(.*?)\"/', $content, $link_matches) ||
            preg_match_all('/'.$type.'=\'(.*?)\'/', $content, $link_matches))
        {
            $extracted_links = $link_matches[1];
        }
        else
        {
            $extracted_links = false;
        }

        return $extracted_links;
    }

    # Allows hash tag links to work normally in context of the overall system
    public function hash_tag_links($content, $type = 'href')
    {
        if(preg_match_all('/'.$type.'=\"#(.*?)\"/', $content, $link_matches) ||
            preg_match_all('/'.$type.'=\'#(.*?)\'/', $content, $link_matches))
        {
            $extracted_links = $link_matches[1];
            $hash_links = array();

            foreach($extracted_links as $extracted_link)
            {
                //$hash_links[$extracted_link] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'#'.$extracted_link;
                $hash_links[$extracted_link] = get_current_uri(1).'#'.$extracted_link;
            }
        }
        else
        {
            $hash_links = false;
        }

        return $hash_links;
    }
    /*** END OF LINK EXTRACTION ******/

    /*** END OF LINK MANAGEMENT ************************/
}