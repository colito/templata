<?php

    function instantiate_class($class_name, $lib = '', $params = array())
    {
        if(empty($lib)) {$lib = strtolower($class_name);} # Uses lowercase of class name if file name include isn't specified

        include_lib($lib); #Includes the class

        if(!empty($params))
        {
            $params_string = implode(',', $params);
            return new $class_name($params_string);
        }
        else
        {
            return new $class_name();
        }
    }

    function get_current_uri($extent = 0)
    {
        switch($extent)
        {
            case 0:
                return $_SERVER['REQUEST_URI'];
            break;
            case 1:
                //return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                $protocol = stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://';
                return "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            break;
        }
    }

    function relative_path($file_root_path)
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

    /*** BROWSER ***********************************************************/
    # Ref: http://www.php.net/get_browser
    function browser_data()
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

    # Ref: http://www.cleverlogic.net/tutorials/how-dynamically-get-your-sites-main-or-base-url
    function get_base_url()
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

    function include_lib($file_name)
    {
        return require_once(T_LIBS.$file_name.'.php');
    }

    function include_system_lib($file_name)
    {
        return require_once(T_SYSTEM.$file_name.'.php');
    }

    function include_tool($file_name)
    {
        return require_once(T_TOOLS.$file_name.'/index.php');
    }

    function current_datetime()
    {
        date_default_timezone_set('Africa/Johannesburg');
        return date('Y-m-d H:i:s');
    }