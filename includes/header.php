<?php
ob_start();
require_once('../fns/page_handler.php');
$config = new Config();


$nav_menu = '
        <ul>
            <li id="<?php echo $home_active_page ?>" class="home"><a href="'.navi_home.'">Home</a></li>
            <li class="solutions"><a href="#">Link 1</a></li>
            <li class="contact"><a href="../create_page">create</a></li>
        </ul>
        ';


function navigation_menu()
{
    $page_handler = new PageHandler();
    $x = $page_handler->link_handler();

    echo '<ul>';
    foreach($x['nav_links'] as $y)
    {
        echo '<li><a href=" '.$y['link'].' ">'.$y['link_name'].'</a></li>';
    }
    echo '</ul>';
}


//$nav_men = $page_handler->link_handler();
//var_dump($nav_men);
?>

<!DOCTYPE HTML>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <title><?php echo $page_name ?></title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">

    <link rel="stylesheet" href="<?php echo main_css_reset?>" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo main_css_normalize?>" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo main_css_grid?>" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo main_css_style?>" type='text/css' media="screen">

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
        <?php navigation_menu() ?>
    </div>

</div>

<div id="panel">
    <?php echo $nav_menu; ?>
</div>

<div class="container_12 clearfix">