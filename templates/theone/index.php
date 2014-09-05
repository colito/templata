<!DOCTYPE HTML>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <!-- Base path: Very important especially when the systems uses clean URLs -->
    {base-url}

    <title>{page-title}</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">

    <link rel="icon" type="image/png" href="{favicon}">

    <!-- CSS Libraries -->

    <!--{templata:css}-->

    <link rel="stylesheet" href="{template-res:css:normalize.css}" type="text/css" media="screen">
    <link rel="stylesheet" href="{template-res:css:grid.css}" type="text/css" media="screen">
    <link href="http://fonts.googleapis.com/css?family=Armata" rel="stylesheet" type="text/css">
    <!-- <link rel="stylesheet" href="{template-res:css:flexslider.css}" type="text/css" media="screen"> -->
    <link rel="stylesheet" href="{template-res:css:style.css}" type='text/css' media="screen">
    <link rel="stylesheet" href="{template-res:css:media_queries.css}" type='text/css' media="screen">

    <link rel="stylesheet" type="text/css" href="{templata:libs}/css/codrops/sidebar_transitions/component.css" />
    <script src="{templata:libs}/js/codrops/modernizr.custom.js"></script>

    <!-- JQuery -->
    {templata:jquery}

    <!-- Header files -->
    {header-files}

</head>

<body {templata:right-click}>

<!--
<div id="st-container" class="st-container">
    <nav class="st-menu st-effect-1" id="menu-1">
        <h2 class="icon icon-lab">Sidebar</h2>
        <ul>
            <li><a href="#">Data Management</a></li>
            <li><a href="#">Location</a></li>
            <li><a href="#">Study</a></li>
            <li><a href="#">Collections</a></li>
            <li><a href="#">Credits</a></li>
        </ul>
    </nav>
</div>

 <div id="st-trigger-effects">
        <button data-effect="st-effect-1">Slide in on top</button>
    </div>
-->


<div id="topper">

    <div id="title">
        <h1><a href="">{templata:app-name}</a></h1>
    </div>

    <div id="switch">
        <img data-effect="st-effect-1" src="images/nav_menu_icon.png">
    </div>


    <div id="navigation">
        {navi:desktop}
    </div>

</div>

<div id="panel">
    {navi:mobile}
</div>

<div class="container_12 clearfix">

    {body-content}

    <div id='footer' class='grid_12'>
        <div id='copyright'>
            <p>&copy; 2013 Success Motivation. All Rights Reserved</p>
        </div>
    </div>
</div>

<!-- Menu toggle for smart phones -->
<!--
<script src="{templata:libs}/js/codrops/classie.js"></script>
<script src="{templata:libs}/js/codrops/sidebarEffects.js"></script>
-->
<script type="text/javascript" charset="utf-8">
    $(document).ready(function(){
        $("#switch").click(function(){
            $("#panel").slideToggle(250);
        });
    });
</script>


<!-- Flexslider js and setting -->
<!--
<script type="text/javascript" src="{template:res}/js/flexslider.js"></script>
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
-->

</body>

</html>
