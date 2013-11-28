<?php
    $page_name = 'File Explore';
    require_once('includes/header.php');
?>

<?php

    require_once('fns/file_fns.php');

    $file_fns = new FileFns();

    //$root = $_SERVER['DOCUMENT_ROOT'].'/emp/wordworld/';
    $root = $config->file_root();

    if(isset($_GET['explore']))
    {
        $file = $_GET['explore'];

        if($file == $root)
        {
            $current_path = '/';
        }
        else
        {
            $current_path = str_replace($root, '', $file);
        }
    }
    else
    {
        $file = '../';
        $current_path = '/';
    }

    $dir = $file_fns->list_directories($file);
?>

    <div id="file_explorer" class="grid_8">
        <a href="file_explore.php"><h3>File Explorer</h3></a>
    </div>

    <div id="file_explore" class="grid_8">

    <?php
        echo '<p class="upper">Current path:  <i class="lower">'.$current_path.'</i></p>';

        if(isset($_GET['explore']))
        {
            echo '<a href="'.$_SERVER['HTTP_REFERER'].'">< back</a> <br>';

            foreach($dir as $list_item)
            {
                $full_path = realpath($file.'/'.$list_item);

                if(is_dir($full_path))
                {
                    echo '<a href="file_explore.php?explore='.$full_path.'" class="upper">'.$list_item.'</a>';
                    echo '<br>';
                }
                else if(is_file($full_path))
                {
                    $full_path = str_replace($root, '', $full_path);

                    echo '<a href="edit_open_file.php?file_path='.$full_path.'" class="lower">'.$list_item.'</a>';
                    echo '<br>';
                }
            }
        }
        else
        {
            foreach($dir as $list_item)
            {
                $full_path = realpath('../'.$list_item);

                if(is_dir($full_path))
                {
                    echo '<a href="file_explore.php?explore='.$full_path.'" style="color:steelblue">'.$list_item.'</a>';
                    echo '<br>';
                }
                else if(is_file($full_path))
                {
                    $full_path = str_replace($root, '', $full_path);

                    echo '<a href="edit_open_file.php?file_path='.$full_path.'" style="color:slategrey">'.$list_item.'</a>';
                    echo '<br>';
                }
            }
        }

    ?>

    </div>

<?php require_once('includes/footer.php')?>