<!--
CSS:
[css:reset.css]
[css:normalize.css]
[css:grid.css]
[css:style.css]

[page:Sample Image Gallery]

<a href="jump/what.php">What's Good?!</a>
<a href="jump/one.php">What's Good?!</a>
<a href="jump/two.php">What's Good?!</a>

<script type="text/javascript" src="js/javascript.js">
<script type="text/javascript" src="js/jquery.js">
<script type="text/javascript" src="js/javascript.js">
<script type="text/javascript" src="js/javascript.js">
-->

<?php

include_lib('imagine');

$imagine = new Imagine();
?>

<div id="content" class="grid_12">
    <h2>Gallery</h2>
</div>

<div id="content">
    <?php $imagine->display_gallery('theone', 300); ?>
</div>