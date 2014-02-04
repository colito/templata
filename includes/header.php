<?php
ob_start();
require_once(APP_ROOT_DIR.'/fns/page_handler.php');
$config = new Config();
$page_handler = new PageHandler();

?>

<!DOCTYPE HTML>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <title><?php echo $page_name ?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">

    <link rel="stylesheet" href="<?php echo $depth.main_css_reset?>" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $depth.main_css_normalize?>" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $depth.main_css_grid?>" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo $depth.main_css_style?>" type='text/css' media="screen">

    <!-- JQuery 2.0.3-->
    <script type="text/javascript" src="<?php echo $depth.main_jquery?>"></script>

</head>

<!-- oncontextmenu when this returns false right-click is disabled -->
<body oncontextmenu="return false">

<div id="topper">

    <div id="title">
         <h1><a href="<?php echo $depth.navi_home ?>"><?php echo $config->site_name; ?></a></h1>
    </div>

    <div id="switch"></div>

    <div id="navigation">
        <?php $page_handler->navigation_menu($depth) ?>
    </div>

</div>

<div id="panel">
    <?php $page_handler->navigation_menu($depth) ?>
</div>

<div class="container_12 clearfix">