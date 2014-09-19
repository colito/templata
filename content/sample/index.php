<!--
[page:Sample Image Gallery]
-->

<?php

$imagine = instantiate_class('Imagine');
$check = instantiate_class('PageHandler', 'page_handler');

$functons = get_defined_functions();

var_dump(get_class_methods('PageHandler'));
var_dump($functons['user']);


?>

<div id="content" class="grid_12">
    <h2>Gallery</h2>
</div>

<div id="content">
    <center>
        <?php $imagine->display_gallery('theone', 310); ?>
    </center>
</div>
