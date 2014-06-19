<?php

    function get_current_uri($extent = 0)
    {
        switch($extent)
        {
            case 0:
                return $_SERVER['REQUEST_URI'];
            break;
            case 1:
                return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
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
        return require_once(T_FNS.$file_name.'.php');
    }

    function include_tool($file_name)
    {
        return require_once(T_TOOLS.$file_name.'/index.php');
    }