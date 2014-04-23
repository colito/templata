<?php
class LinkHandler
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
        $config = new Config();
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
    # Gets href="" link
    public function extract_hyper_links($content)
    {
        if(preg_match_all('/<a href=\"(.*?)\">/', $content, $link_matches) ||
            preg_match_all('/<a href=\'(.*?)\'>/', $content, $link_matches))
        {
            $extracted_links = $link_matches[1];
        }
        else
        {
            $extracted_links = 'no link found';
        }

        return $extracted_links;
    }

    # Gets href="" link
    public function extract_href_links($content)
    {
        if(preg_match_all('/href=\"(.*?)\"/', $content, $link_matches) ||
            preg_match_all('/href=\'(.*?)\'/', $content, $link_matches))
        {
            $extracted_links = $link_matches[1];
        }
        else
        {
            $extracted_links = 'no links found';
        }

        return $extracted_links;
    }

    # Gets src="" link
    public function extract_src_links($content)
    {
        if(preg_match_all('/src=\"(.*?)\"/', $content, $source_matches) ||
            preg_match_all('/src=\'(.*?)\'/', $content, $source_matches))
        {
            $extracted_links = $source_matches[1];
        }
        else
        {
            $extracted_links = 'no links found';
        }

        return $extracted_links;
    }

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
            $extracted_links = 'no links found';
        }

        return $extracted_links;
    }
    /*** END OF LINK EXTRACTION ******/

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
                    }
                }
            }
        }

        # modify urls to make them useful to the system
        $new_href_links = array();
        foreach($raw_href_links3 as $key => $raw_href_links4)
        {
            # notation -> ?category=category&id=page_name
            $exploded_link = explode('/',$raw_href_links4);

            if(!empty($exploded_link[0]) && !empty($exploded_link[1]))
            {
                if(empty($new_href_links[$key]))
                {
                    $new_href_links[$key] = '?category='.$exploded_link[0].'&id='.$exploded_link[1];
                }
            }
        }

        return $new_href_links;
    }
    /*** END OF PHYSICAL LINK ALTERING ***/

    /*** END OF LINK MANAGEMENT ************************/
}