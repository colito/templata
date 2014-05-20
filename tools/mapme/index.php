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

define('ROOT_PIPE', '<style=color:red;>|- </style>');

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
                echo $indent, ROOT_PIPE, $split[$new_depth] ,'<br>';
                break;
            default:
                echo $indent, '|- ', $split[$new_depth] ,'<br>';
        }


    }
}