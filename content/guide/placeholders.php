[page:Template Guide - Placeholders]

<div id="content" xmlns="http://www.w3.org/1999/html">
    <p><h2>Note:</h2></p>
    <p>All placeholders should be contained within <b>braces { }</b></p>

    <br>

    <p id="current"><h2>Current Placeholders</h2></p>
    <p>
        <ul>
            <li><del>app_name</del></li>
            <li><del>templata_css</del> </li>
            <li><del>base_url</del> </li>
            <li>relative</li>
            <li>favicon </li>
            <li><del>templata_libs</del></li>
            <li><del>template_res</del></li>
            <li><del>templata_images</del> </li>
            <li><del>templata_jquery</del> </li>
            <li>validation:contact-form </li>
            <li><del>dnavigation_menu</del> </li>
            <li><del>mobile_navigation_menu</del> </li>
            <li><del>right_click</del></li>
            <li><del>body_content</del></li>
        </ul>
    </p>

    <br>

    <p>
        <h2 id="new">Proposed New Placeholders</h2>
    </p>

    <p id="templata">
        <h3>Templata</h3>
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

    <p id="template">
        <h3>Template (Template specific resources)</h3>
        <ul>
            <li>template:resource-name </li>
            <li>template:css </li>
            <li>template:css:filename </li>
            <li>template:favicon </li>
            <li>template:js </li>
            <li>template:js:filename </li>
        </ul>
    </p>

    <p><h3>Navigation</h3></p>
    <p id="navi">

        File containing navigation links is stored within the includes directory
        of the template directory.
        <br>
        <ul>
            <li>navi:desktop </li>
            <li>navi:mobile </li>
        </ul>
    </p>

    <p id="other">
        <h3>Other Placeholders</h3>

        <ul>
            <li>base-url</li>
            <li>relative</li>
            <li>body-content</li>
        </ul>
    </p>
</div>