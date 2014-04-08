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
    {templata_css}

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
            <p>&copy; 2013 Templata. All Rights Reserved</p>
        </div>
    </div>
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