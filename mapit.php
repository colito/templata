<?php

//var_dump(glob('*'));

$dirs = glob('*');

foreach($dirs as $dir)
{
    if(is_dir($dir))
    {
       $list[$dir] .= glob($dir);
    }
}

foreach($dirs as $file)
{
    if(is_file($file))
    {
        $list[] = $file;
    }
}

var_dump($list);

?>