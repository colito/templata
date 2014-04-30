[page:Template Guide - Placeholders]

<?php

var_dump(relative_path(dirname(__FILE__)));

?>

<div id="content" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
    <p><h2>Note:</h2></p>
    <p>All placeholders should be contained within braces ({})</p>

    <br>

    <p id="current"><h2>Current Placeholders</h2></p>
    <p>
        <ul>
            <li><a href="#app_name">app_name</a></li>
            <li><a href="#">templata_css</a> </li>
            <li><a href="#base_url">base_url</a> </li>
            <li><a href="#">relative</a></href> </li>
            <li><a href='#'>favicon</a> </li>
            <li>templata_libs</li>
            <li>template_res</li>
            <li>templata_images </li>
            <li>templata_jquery </li>
            <li>validation:contact-form </li>
            <li>navigation_menu </li>
            <li>mobile_navigation_menu </li>
            <li>right_click</li>
        </ul>
    </p>

    <br>

    <p id="new navigation">
        <h2>Proposed New Placeholders</h2>
        <h3>Navigation</h3>
    </p>

    <p>
        File containing navigation links is stored within the includes directory
        of the template directory.
        <br>
        <ul>
            <li>navi:desktop </li>
            <li>navi:mobile </li>
        </ul>
    </p>

    <p id="templata"><h3>Templata</h3></p>
    <p>
        <ul>
            <li>templata:app-name </li>
            <li>templata:right-click </li>
            <li>templata:css </li>
            <li>templata:css:filename </li>
            <li>templata:relative </li>
            <li>templata:libs </li>
            <li>template:images </li>
            <li>templata:jquery </li>
        </ul>
    </p>

    <p id="template"><h3>Template (Template specific resources)</h3></p>
    <p>
        <ul>
            <li>template:resource-name </li>
            <li>template:css </li>
            <li>template:css:filename </li>
            <li>template:favicon </li>
        <ul>
    </p>
</div>