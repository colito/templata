<?php
abstract class Operator
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

    /*** END OF LINK MANAGEMENT ************************/



    /*** NAVIGATION ***********************************************************************/
    public function navigation_menu($depth = null)
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
    /*** END OF NAVIGATION ************************/




    /*** SOURCE FILES **************************************************************/
    public function css_files()
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
                if(preg_match_all("/\[(css:.*?)\]/", $line, $css_matches))
                {
                    $clean_lines[] = $css_matches[1];
                }
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

        $css_links = '';
        foreach($css_files as $css_file)
        {
            $css_links .= '<link rel="stylesheet" href="{templata_libs}/css/'.$css_file.'" type="text/css" media="screen">';
        }

        return $css_links;
    }

    public function get_jquery($depth)
    {
        $config = new Config();
        $jquery_path = $depth.$config->templata_jquey_path;

        $resource_file = glob($jquery_path.'/jquery*');
        $resource_file['jquery'] = $resource_file[0];
        unset($resource_file[0]);

        $jquery_link = '<script type="text/javascript" src="'.$resource_file['jquery'].'"></script>';

        return $jquery_link;
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


?>