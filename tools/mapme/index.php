<?php

# Ref: http://stackoverflow.com/questions/12077177/how-does-recursiveiteratoriterator-work-in-php

$path = '../../';

# Example 1
//$dir  = new DirectoryIterator($path);

//var_dump($dir);

/*echo "[$path] <br>";
foreach ($dir as $file) {
    echo " ├ $file <br>";
}*/

# Example 2
/*$files = new IteratorIterator($dir);

echo "[$path] <br>";
foreach ($files as $file) {
    echo " ├ $file <br>";
}*/

# Example 3
/*$dir  = new RecursiveDirectoryIterator($path);

echo "[$path] <br>";
foreach ($dir as $file) {
    echo " |- $file <br>";
}*/

# Example 4 - The Working Example
/*$dir  = new RecursiveDirectoryIterator($path);
$files = new RecursiveIteratorIterator($dir);

echo "[$path] <br>";
foreach ($files as $file) {
    if(strpos($file,'git') == false && strpos($file,'.idea') == false)
    {
        echo "|- $file <br>";
    }
}*/

# Example 5 - Advanced
$path = '.';
$dir  = new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS);
$files = new RecursiveIteratorIterator($dir, RecursiveIteratorIterator::SELF_FIRST);

define('DEFAULT_COLOR', '<b style=color:slategrey;>|-- </b>');
define('ROOT_PIPE', '<b style=color:red;>|-- </b>');
define('LEVEL_2', '<b style=color:green;>|-- </b>');
define('LEVEL_3', '<b style=color:dodgerblue;>|-- </b>');
define('LEVEL_4', '<b style=color:goldenrod;>|-- </b>');

echo '['.$path.'] <br>';
foreach ($files as $key => $file) {
    $indent = str_repeat('&nbsp;&nbsp;&nbsp;', $files->getDepth());
    if(strpos($file,'git') == false && strpos($file,'.idea') == false)
    {
        $depth = $files->getDepth();
        $split = explode('/', $file);

        $new_depth = count($split) - 1;

        switch($new_depth)
        {
            case 1:
                $pipe_color = ROOT_PIPE;
                break;
            case 2:
                $pipe_color = LEVEL_2;
                break;
            case 3:
                $pipe_color = LEVEL_3;
                break;
            case 4:
                $pipe_color = LEVEL_4;
                break;
            default:
                $pipe_color = DEFAULT_COLOR;
        }

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