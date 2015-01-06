<?php

function TConfig($class = 'Application')
{
    $config = init($class);
    return $config;
}

function init($class)
{
    $file_name = strtolower($class).'.php';
    require_once('config/'.$file_name);

    $class_name = $class.'Config';

    return new $class_name();
}

# application root
require_once('root.php');
