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
