<!--
[page:Sample Image Gallery]
-->

<?php

$imagine = instantiate_class('Imagine');
$check = instantiate_class('PageHandler', 'system/page_handler');

?>

<div id="content" class="grid_12">
    <h2>Gallery</h2>
</div>

<div id="content">
    <center>
        <?php $imagine->display_gallery('theone', 310); ?>
    </center>
</div>
