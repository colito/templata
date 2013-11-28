<?php
ob_start();
session_start();

if($page_name != 'Index Page')
{
    if(empty($_SESSION['admin_active']))
    {
        header('Location: index.php');
    }
    else
    {
        $_SESSION['start_time'] = time();
        $admin_session = $_SESSION['admin_active'];
    }
}
else
{
    if(!empty($_SESSION['admin_active']))
    {
        header('Location: open_file.php');
    }
}

require_once('config.php');
require_once('fns/user_handler.php');

$user_handler = new UserHandler();
$config = new Config();

?>

<html>
<head>
    <title><?php echo $page_name?></title>

    <link rel="stylesheet" href="css/normalize.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/grid.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen" />

    <!-- <script language="javascript" type="text/javascript" src="js/codepress/codepress.js"></script>-->
    <script language="javascript" type="text/javascript" src="js/edit_area/edit_area_full.js"></script>
    <script language="javascript" type="text/javascript">
        editAreaLoader.init({
            id : "file_content"		// textarea id
            ,syntax: "<?php echo $file_extension; ?>"	// syntax to be uses for highgliting
            ,start_highlight: true		// to display with highlight mode on start-up
        });
    </script>

    <script type="text/javascript">
        function view_file_explorer()
        {
            window.location.assign("file_explore.php")
        }
    </script>

</head>

<body>

<div id="topper">

    <div id="title">
        <a href="index.php"><h2>Dunamis</h2></a>
    </div>

    <?php if($page_name != 'Index Page') {

        echo '

            <div id="links" class="animated">
                <a href="sign_out.php">Sign out</a>
            </div>

            <div id="open_file">
                <form method="post" action="validator.php">
                    <input type="hidden" name="file_job" value="open">
                    <input type="text" name="file_path" width="80" placeholder="Specify file path">
                    <input class="open_btn" type="submit" value="Open">
                </form>
            </div>

            <div id="links">
                <a href="open_file.php">Home</a>&nbsp;
                <a href="file_explore.php">Browse</a>&nbsp;
                <a href="shell_command.php">Shell</a>&nbsp;
            </div>
           ';
        }
    ?>

</div>

<div class="container_12">

