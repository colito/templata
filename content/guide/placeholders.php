[page:Template Guide - Placeholders]

<div id="content" xmlns="http://www.w3.org/1999/html">
    <p><h2>Note:</h2></p>
    <p>All placeholders should be contained within <b>braces { }</b></p>

    <p id="current"><h2>Current Placeholders</h2>
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
            <li>relative</li>
            <li>favicon </li>
        </ul>
    </p>
</div>