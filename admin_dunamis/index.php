<?php

    $page_name = 'Index Page';
    require_once('includes/header.php');

    $validator = $user_handler;

    if(isset($_GET['feedback']))
    {
        $feedback = ($_GET['feedback']);
        $feedback = '<i class="error">'.$feedback.'</i>';
    }
    else
    {
        $feedback = '<i class="success">Please enter your log in details</i>';
    }

    if(($_SERVER['REQUEST_METHOD'] == 'POST'))
    {
        $validator->validate_login($_POST['user_name'], $_POST['user_password']);
    }

?>

<div class="stalactite prefix_3 grid_6">

    <h3>Sign in</h3>

    <p><?php echo $feedback; ?></p>

    <form id="auth-form" method="post" action="index.php">
        <p>
            User name:
            <br>
            <input type="text" name="user_name" width="80" placeholder="user name" value="<?php echo $_POST['user_name']; ?>">
        </p>
        <p>
            Password:
            <br>
            <input type="password" name="user_password" width="80" placeholder="password">
        </p>

        <input class="open_btn" type="submit" value="Sign in">
    </form>
</div>

<?php require_once('includes/footer.php');?>