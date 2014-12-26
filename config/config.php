<?php
Class Config
{
    function __construct($class_file = 'Application')
    {
        $file_name = strtolower($class_file).'.php';
        require_once('config/'.$file_name);

        var_dump($file_name);
    }
}

# application root
require_once('root.php');
