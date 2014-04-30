<?php
require_once('functions.php');
abstract class Operator
{

    /*** BASE URL ****************************************************************************************/

    # Ref: http://www.cleverlogic.net/tutorials/how-dynamically-get-your-sites-main-or-base-url
    public function get_base_url()
    {
        /* First we need to get the protocol the website is using */
        $protocol = strtolower(substr($_SERVER["SERVER_PROTOCOL"], 0, 5)) == 'https' ? 'https://' : 'http://';

        /* returns /myproject/index.php */
        $path = $_SERVER['PHP_SELF'];

        /*
         * returns an array with:
         * Array (
         *  [dirname] => /myproject/
         *  [basename] => index.php
         *  [extension] => php
         *  [filename] => index
         * )
         */
        $path_parts = pathinfo($path);
        $directory = $path_parts['dirname'];
        /*
         * If we are visiting a page off the base URL, the dirname would just be a "/",
         * If it is, we would want to remove this
         */
        $directory = ($directory == "/") ? "" : $directory;

        /* Returns localhost OR mysite.com */
        $host = $_SERVER['HTTP_HOST'];

        /*
         * Returns:
         * http://localhost/mysite
         * OR
         * https://mysite.com
         */
        return $protocol . $host . $directory . '/';
    }
    /*** END OF BASE URL ***********************************/


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
                $hash_links[$extracted_link] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'#'.$extracted_link;
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



    /*** NAVIGATION ***********************************************************************/
    public function navigation_menu($depth = null)
    {
        $x = $this->link_handler();

        if($x == false)
        {
            return false;
        }

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
        $active_template = $config->active_template;
        $links_file = 'templates/'.$active_template.'/'.$links;

        if(!file_exists($links_file))
        {
            return false;
        }

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

        if(!$css_files)
        {
            return 'No CSS links found';
        }

        $css_links = '';
        foreach($css_files as $css_file)
        {
            $css_links .= '<link rel="stylesheet" href="{template_res}/css/'.$css_file.'" type="text/css" media="screen">';
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

    /*** BROWSER ***********************************************************/
    # Ref: http://www.php.net/get_browser
    public function get_browser()
    {
        $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $bname = 'Unknown';
        $platform = 'Unknown';
        $version= "";

        //First get the platform?
        if (preg_match('/linux/i', $u_agent)) {
            $platform = 'linux';
        }
        elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
            $platform = 'mac';
        }
        elseif (preg_match('/windows|win32/i', $u_agent)) {
            $platform = 'windows';
        }

        // Next get the name of the useragent yes seperately and for good reason
        if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Internet Explorer';
            $ub = "MSIE";
        }
        elseif(preg_match('/Firefox/i',$u_agent))
        {
            $bname = 'Mozilla Firefox';
            $ub = "Firefox";
        }
        elseif(preg_match('/Chrome/i',$u_agent))
        {
            $bname = 'Google Chrome';
            $ub = "Chrome";
        }
        elseif(preg_match('/Safari/i',$u_agent))
        {
            $bname = 'Apple Safari';
            $ub = "Safari";
        }
        elseif(preg_match('/Opera/i',$u_agent))
        {
            $bname = 'Opera';
            $ub = "Opera";
        }
        elseif(preg_match('/Netscape/i',$u_agent))
        {
            $bname = 'Netscape';
            $ub = "Netscape";
        }

        // finally get the correct version number
        $known = array('Version', $ub, 'other');
        $pattern = '#(?<browser>' . join('|', $known) .
            ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
        if (!preg_match_all($pattern, $u_agent, $matches)) {
            // we have no matching number just continue
        }

        // see how many we have
        $i = count($matches['browser']);
        if ($i != 1) {
            //we will have two since we are not using 'other' argument yet
            //see if version is before or after the name
            if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
                $version= $matches['version'][0];
            }
            else {
                $version= $matches['version'][1];
            }
        }
        else {
            $version= $matches['version'][0];
        }

        // check if we have a number
        if ($version==null || $version=="") {$version="?";}

        return array(
            'userAgent' => $u_agent, #user agent
            'name'      => $bname, #browser name
            'version'   => $version, # browser version
            'platform'  => $platform, # OS
            'pattern'    => $pattern # regex pattern
        );
    }
}
