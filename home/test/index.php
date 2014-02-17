<?php
require_once('../../config.php');
require_once(T_FNS.'page_handler.php');

$page_handler = new PageHandler();

$page_title = 'Test';
$relative_path_depth = $page_handler->relative_link_path(dirname(__FILE__));
$body_content = $page_handler->get_content($relative_path_depth, 'sample/index2.php');

$page_handler->output_template($page_title, $relative_path_depth, $body_content);

?>
