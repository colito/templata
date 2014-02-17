<?php
ob_start();
require_once('../config.php');
$config = new Config();
?>

<!DOCTYPE HTML>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <title>{page_title}</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">

    <link rel="stylesheet" href="<?php echo main_css?>normalize.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo main_css?>grid.css" type="text/css" media="screen">
    <link href="http://fonts.googleapis.com/css?family=Armata" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo main_css?>flexslider.css" type="text/css" media="screen">
    <link rel="stylesheet" href="<?php echo main_css?>style.css" type='text/css' media="screen">

    <!-- GA -->
    <script type="text/javascript">
        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-38880588-1']);
        _gaq.push(['_trackPageview']);

        (function()
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>

    <!-- JQuery 2.0.3-->
    <script type="text/javascript" src="<?php echo main_jquery?>"></script>

</head>

<body {right_click}>

<div id="topper">

    <div id="title">
        <h1><a href="<?php echo navi_home ?>"><?php echo $config->site_name; ?></a></h1>
    </div>

    <div id="switch"></div>

    <div id="navigation">
        <ul>
            <li id="<?php echo $home_active_page ?>" class="home"><a href="<?php echo navi_home ?>">Home</a></li>
            <li id="<?php echo $solutions_active_page ?>" class="solutions"><a href="<?php echo navi_solutions ?>">Solutions</a></li>
            <li id="<?php echo $contact_active_page ?>" class="contact"><a href="<?php echo navi_contact ?>">Contact Us</a></li>
        </ul>
    </div>

</div>

<div id="panel">
    <ul>
        <li id="<?php echo $home_active_page ?>" class="home"><a href="<?php echo navi_home ?>">Home</a></li>
        <li id="<?php echo $solutions_active_page ?>" class="solutions"><a href="<?php echo navi_solutions ?>">Solutions</a></li>
        <li id="<?php echo $contact_active_page ?>" class="contact"><a href="<?php echo navi_contact ?>">Contact Us</a></li>
    </ul>
</div>

<div class="container_12 clearfix">

    {body_content}

    <div id='footer' class='grid_12'>
        <div id='copyright'>
            <p>&copy; 2013 Success Motivation. All Rights Reserved</p>
        </div>
    </div>
</div>

<?php
if($page_name == 'Home')
{
    require_once(main_include.'slider_setting.php');
}
?>

</body>
<!-- Menu toggle for smart phones -->
<script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
        $("#switch").click(function(){
            $("#panel").slideToggle(250);
        });
    });
</script>
</html>
<?php ob_flush();?>