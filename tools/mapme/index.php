<?php
# Ref: http://stackoverflow.com/questions/12077177/how-does-recursiveiteratoriterator-work-in-php

$path = '.';
$dir  = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
$files = new RecursiveIteratorIterator($dir, RecursiveIteratorIterator::SELF_FIRST);

function determine_pipe_color($depth)
{
    $default_color = '<b style=color:slategrey;>|-- </b>';
    $root_pipe = '<b style=color:red;>|-- </b>';
    $level_2 = '<b style=color:green;>|-- </b>';
    $level_3 = '<b style=color:dodgerblue;>|-- </b>';
    $level_4 = '<b style=color:goldenrod;>|-- </b>';

    switch($depth)
    {
        case 1:
            $pipe_color = $root_pipe;
            break;
        case 2:
            $pipe_color = $level_2;
            break;
        case 3:
            $pipe_color = $level_3;
            break;
        case 4:
            $pipe_color = $level_4;
            break;
        default:
            $pipe_color = $default_color;
    }

    return $pipe_color;
}

echo '['.$path.'] <br>';
foreach ($files as $key => $file) {
    $indent = str_repeat('&nbsp;&nbsp;&nbsp;', $files->getDepth());
    if(strpos($file,'git') == false && strpos($file,'.idea') == false)
    {
        //$depth = $files->getDepth();
        $split = explode('/', $file);

        $new_depth = count($split) - 1;

        $pipe_color = determine_pipe_color($new_depth);

        if(is_dir($file))
        {
            echo $indent, $pipe_color, '<sun style=color:steelblue;>'.$split[$new_depth].'</sun>' ,'<br>';
        }
        else
        {
            echo $indent, $pipe_color, '<a href="'.$file.'" style=color:lightslategrey;>'.$split[$new_depth].'</a>' ,'<br>';
        }
    }
}