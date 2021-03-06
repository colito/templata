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

    public function nav_link_handler()
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


    /*** PHYSICAL LINK ALTERING ****************************************************************/
    # Turns standard relative hyperlinks into links that are userfriendly to the overall system
    # Links should strictly be one level deep in order for them to work
    # First part of the link represents a physical directory within the systems content directory
    # and the second part represents the actual file whose content is required to be displayed.
    public function href_link_transformer($href_source)
    {
        $raw_href_links = $this->extract_links($href_source);

        $raw_href_links3 = array();
        foreach($raw_href_links as $raw_href_links2)
        {
            # eliminating links containing 'www' or 'http' because such links need not to be re-written
            if(strpos($raw_href_links2, 'http') === false)
            {
                if(strpos($raw_href_links2, 'www') === false)
                {
                    if(strpos($raw_href_links2, '.co') === false)
                    {
                        if(strpos($raw_href_links2, '.html') != false || strpos($raw_href_links2, '.php') != false)
                        {
                            $raw_href_links3[$raw_href_links2] = $raw_href_links2;
                        }
                        elseif(strpos($raw_href_links2, '.') == false && $raw_href_links2 != '#' && $raw_href_links2 != '')
                        {
                            $raw_href_links3[$raw_href_links2] = $raw_href_links2;
                        }
                    }
                }
            }
        }

        # modify urls to make them useful to the system in absence of .htaccess file
        $new_href_links = array();
        foreach($raw_href_links3 as $raw_href_links4)
        {
            # notation -> ?category=category&article=page
            $exploded_link = explode('/',$raw_href_links4);

            if(count($exploded_link) == 3)
            {
                @$new_href_links[$raw_href_links4] = '?category='.$exploded_link[0].'&article='.$exploded_link[1].'&sub-article='.$exploded_link[2];
            }
            elseif(count($exploded_link) == 2)
            {
                @$new_href_links[$raw_href_links4] = '?category='.$exploded_link[0].'&article='.$exploded_link[1];
            }
            elseif(count($exploded_link) == 1)
            {
                @$new_href_links[$raw_href_links4] = '?category='.$exploded_link[0];
            }
        }

        return $this->replace_links($new_href_links, $href_source, 'href');
    }

    # Replaces links within the HTML source
    public function replace_links($links_to_replace, $source, $type='href')
    {
        if(is_array($links_to_replace))
        {
            foreach($links_to_replace as $key=>$link)
            {
                $source = str_replace($type.'="'.$key.'"', $type.'="'.$link.'"', $source);
                $source = str_replace($type.'=\''.$key.'\'', $type.'=\''.$link.'\'', $source);
            }
        }

        return $source;
    }
    /*** END OF PHYSICAL LINK ALTERING ***/



    /*** LINK EXTRACTION **************************************************/

    # Gets src="" or href="" or any other link depending on the type parameter. Default = href
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