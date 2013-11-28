<?php
if(!empty($_POST['user_name']))
{
    $user_name = $_POST['user_name'];
    if($user_name == 'admin_bogosi')
    {
        if(!empty($_POST['user_password']))
        {
            $pword = $_POST['user_password'];
            if($pword == 'KEmohae')
            {
                session_start();
                $_SESSION['admin_active'] = 'admin_bogosi';
                header('Location: open_file.php');
            }
            else
            {
                echo 'Incorrect login details!';
            }
        }
        else
        {
            echo 'Please enter password';
        }
    }
    else
    {
        echo 'Incorrect login details!';
    }
}
else
{
    echo 'Please enter your details';
}
?>
