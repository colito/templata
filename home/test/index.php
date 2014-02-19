<?php
require_once('../../config.php');
require_once(T_FNS.'page_handler.php');

$page_handler = new PageHandler();

$page_title = 'Test';
$relative_path_depth = $page_handler->relative_link_path(dirname(__FILE__));
$body_content = $page_handler->get_content($relative_path_depth, 'theone','solutions.php');

$page_handler->output_page($page_title, $relative_path_depth, $body_content);

//var_dump($page_handler->get_resource($relative_path_depth, 'jquery'));
//var_dump($page_handler->get_jquery($relative_path_depth));
//var_dump($page_handler->main_libraries($relative_path_depth));
?>
