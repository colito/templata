<?php

session_start();
if(empty($_SESSION['admin_active']))
{
    header('Location: index.php');
}

ob_start();

    $file_job = $_POST['file_job'];

    if($file_job == 'open')
    {
        if(empty($_POST['file_path']))
        {
            echo "No file path specified";
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
        else
        {
            $file_path = $_POST['file_path'];
            if(file_exists('../'.$file_path))
            {
                if(strpos($file_path, '.'))
                {
                    if(is_readable('../'.$file_path))
                    {
                        header('Location: edit_open_file.php?file_path='.$file_path);
                    }
                    else
                    {
                        header('Location: open_file.php?file_open=unreadable');
                    }
                }
                else
                {
                    header('Location: open_file.php?file_open=invalid_file');
                }
            }
            else
            {
                header('Location: open_file.php?file_open=not_found');
            }
        }
    }
    elseif($file_job == 'create')
    {
        if(empty($_POST['new_file']))
        {
            echo "No file path specified";
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
        else
        {
            $new_file = $_POST['new_file'];

            if(file_exists('../'.$new_file))
            {
                header('Location: open_file.php?file_create=exists');
            }
            else
            {
                //header('Location: '.$_SERVER['HTTP_REFERER']);

                if(strpos($new_file, '.'))
                {
                    $handle = fopen($new_file, 'w') ;//or die('Cannot open file:  '.$new_file); # implicitly creates file

                    if($handle)
                    {
                        $result = 'true';
                    }
                    else
                    {
                        $result = 'false';
                    }
                    header('Location: open_file.php?file_create='.$result);
                }
                else
                {
                    //header('Location: '.$_SERVER['HTTP_REFERER']);
                    header('Location: open_file.php?file_create=false');
                }
            }
        }
    }

ob_flush();
?>