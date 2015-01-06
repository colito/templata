<!DOCTYPE HTML>
<html lang="en" xmlns="http://www.w3.org/1999/html">
    <head>
        <!-- Base path: Very important especially when the systems uses clean URLs -->
        {base-url}
        <title>{page-title}</title>
        {meta}
        {favicon}
        <!-- CSS Libraries -->
        {templata:css}
        <!-- JQuery -->
        {templata:jquery}
        <!-- Header files -->
        {header-files}
    </head>

    <body {templata:right-click}>

        <div id="topper">

            <div id="title">
                <h1><a href="">{templata:app-name}</a></h1>
            </div>

            <div id="switch"></div>

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
        {js-toggle-menu}

        <!-- Flexslider js and setting -->
        {flexslider-js}
        {flexslider-settings}
    </body>
</html>
