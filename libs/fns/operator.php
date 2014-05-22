<?php
require_once('functions.php');
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
            $css_links .= '<link rel="stylesheet" href="{template:res}/css/'.$css_file.'" type="text/css" media="screen">' . "\n\n";
        }

        return $css_links;
    }

    public function unpack_header_files()
    {

    }

    public function get_jquery($depth)
    {
        $config = new Config();
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