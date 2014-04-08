<!DOCTYPE HTML>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <!-- Base path: Very important especially when the systems uses clean URLs -->
    {base_url}

    <title>{page_title}</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">

    <link rel="icon" type="image/png" href="{favicon}">

    <!-- CSS Libraries -->

    <!--{templata_css}-->

    <link rel="stylesheet" href="{template_res}/css/normalize.css" type="text/css" media="screen">
    <link rel="stylesheet" href="{template_res}/css/grid.css" type="text/css" media="screen">
    <link href="http://fonts.googleapis.com/css?family=Armata" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{template_res}/css/flexslider.css" type="text/css" media="screen">
    <link rel="stylesheet" href="{template_res}/css/style.css" type='text/css' media="screen">

    <!-- GA -->
    <!--
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
    -->

    {templata_jquery}

</head>

<body {right_click}>

<div id="topper">

    <div id="title">
        <h1><a href="index.php">{app_name}</a></h1>
    </div>

    <div id="switch"></div>

    <div id="navigation">
        {navigation_menu}
    </div>

</div>

<div id="panel">
    {mobile_navigation_menu}
</div>

<div class="container_12 clearfix">

    {body_content}

    <div id='footer' class='grid_12'>
        <div id='copyright'>
            <p>&copy; 2013 Success Motivation. All Rights Reserved</p>
        </div>
    </div>
</div>

<script type="text/javascript" src="{template_res}/js/flexslider.js"></script>
<script type="text/javascript" charset="utf-8">
    $(window).load(function() {
        $('.flexslider').flexslider({
            animation: "slide",
            easing: "string",
            slideshowSpeed: 7000,
            animationSpeed: 850
        });
    });
</script>

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