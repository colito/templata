<?php
ob_start();
require_once('../config.php');
$config = new Config();
?>

<!DOCTYPE HTML>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <title><?php echo $page_name ?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">

    <link rel="stylesheet" href="<?php echo main_css?>normalize.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo main_css?>grid.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo main_css?>style.css" type='text/css' media="screen">

    <!-- JQuery 2.0.3-->
    <script type="text/javascript" src="<?php echo main_jquery?>"></script>

</head>

<body oncontextmenu="return false">

<div id="topper">

    <div id="title">
        <h1><a href="<?php echo navi_home ?>"><?php echo $config->site_name; ?></a></h1>
    </div>

    <div id="switch"></div>

    <div id="navigation">
        <ul>
            <li id="<?php echo $home_active_page ?>" class="home"><a href="<?php echo navi_home ?>">Home</a></li>
            <li class="solutions"><a href="#">Link 1</a></li>
            <li class="contact"><a href="../create_page">create</a></li>
            <!-- <li class="admin"><a href="<?php echo navi_admin ?>">admin</a></li>-->
        </ul>
    </div>

</div>

<div id="panel">
    <ul>
        <li id="<?php echo $home_active_page ?>" class="home"><a href="<?php echo navi_home ?>">Home</a></li>
    </ul>
</div>

<div class="container_12 clearfix">