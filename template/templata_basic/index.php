<!DOCTYPE HTML>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>

    <title>{page_title}</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale = 1.0, user-scalable = no">

    <link rel="icon" type="image/png" href="{main_image_directory}/favicon.ico">

    <link rel="stylesheet" href="{template_res}/css/reset.css" type="text/css" media="screen">
    <link rel="stylesheet" href="{template_res}/css/normalize.css" type="text/css" media="screen">
    <link rel="stylesheet" href="{template_res}/css/grid.css" type="text/css" media="screen">
    <link rel="stylesheet" href="{template_res}/css/style.css" type='text/css' media="screen">

    <!-- JQuery 2.0.3-->

    <script type="text/javascript" src="{relative}/js/jquery-2.0.3.min.js"></script>


</head>

<!-- oncontextmenu when this returns false right-click is disabled -->
<body {right_click}>

<div id="topper">

    <div id="title">
        <h1><a href="{relative}home">{app_name}</a></h1>
    </div>

    <div id="switch"></div>

    <div id="navigation">
        {navigation_menu}
    </div>

</div>

<div id="panel">
    {mobi_navigation_menu}
</div>

<div class="container_12 clearfix">
    {body_content}
</div>

<div id="footer">
    <!-- <p>Copyright (c) 2013</p> -->
</div>
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