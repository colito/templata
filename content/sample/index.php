<!--
[page:Sample Image Gallery]
-->

<?php

include_lib('imagine');

$imagine = new Imagine();
?>

<div id="content" class="grid_12">
    <h2>Gallery</h2>
</div>

<div id="content">
    <center>
        <?php $imagine->display_gallery('theone', 310); ?>
    </center>
</div>
