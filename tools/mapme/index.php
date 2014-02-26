<?php
require_once('config.php');
$page_name = 'File Explore';
?>

<?php

//$root = $_SERVER['DOCUMENT_ROOT'].'/emp/wordworld/';
$root = APP_ROOT_DIR;

//$current_path = '/';

$dir = list_directories($file);

function list_directories($file)
{
    # get a directory listing
    $dir = array_diff (scandir (realpath($file)),
        #folders / files to ignore
        array ('.', '..', '.DS_Store', 'Thumbs.db', 'admin', '.idea')
    );

    #sort folders first, then by type, then alphabetically
    usort ($dir, create_function ('$a,$b', '
                            return	is_dir ($a)
                                ? (is_dir ($b) ? strnatcasecmp ($a, $b) : -1)
                                : (is_dir ($b) ? 1 : (
                                    strcasecmp (pathinfo ($a, PATHINFO_EXTENSION), pathinfo ($b, PATHINFO_EXTENSION)) == 0
                                    ? strnatcasecmp ($a, $b)
                                    : strcasecmp (pathinfo ($a, PATHINFO_EXTENSION), pathinfo ($b, PATHINFO_EXTENSION))
                                ))
                            ;
                        '));
    return $dir;
}

//var_dump(list_directories($file));
//var_dump(APP_ROOT_DIR);
//var_dump($file);

?>

    <div id="file_explorer" class="grid_8">
        <a href="mapme.php"><h3>File Explorer</h3></a>
    </div>

    <div id="file_explore" class="grid_8">

        <?php
        //echo '<p class="upper">Current path:  <i class="lower">'.$current_path.'</i></p>';

        if(isset($_GET['explore']))
        {
            echo '<a href="'.$_SERVER['HTTP_REFERER'].'">< back</a> <br>';

            foreach($dir as $list_item)
            {
                $full_path = realpath($file.'/'.$list_item);

                var_dump($full_path);

                if(is_dir($full_path))
                {
                    echo '<a href="mapme.php?explore='.$full_path.'" class="upper">'.$list_item.'</a>';
                    echo '<br>';
                }
                else if(is_file($full_path))
                {
                    $full_path = str_replace($root, '', $full_path);

                    echo '<a href="'.navi_edit_file.'?file_path='.$full_path.'" class="lower">'.$list_item.'</a>';
                    echo '<br>';
                }
            }
        }
        else
        {
            foreach($dir as $list_item)
            {
                $full_path = realpath($list_item);

                if(is_dir($full_path))
                {
                    echo '<a href="mapme.php?explore='.$full_path.'" class="upper">'.$list_item.'</a>';
                    echo '<br>';
                }
                else if(is_file($full_path))
                {
                    $full_path = str_replace($root, '', $full_path);

                    echo '<a href="'.navi_edit_file.'?file_path='.$full_path.'" class="lower">'.$list_item.'</a>';
                    echo '<br>';
                }
            }
        }

        ?>

    </div>