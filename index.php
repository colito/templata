<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('config.php');
require_once(T_FNS.'page_handler.php');

$config = new Config();
$page_handler = new PageHandler();

$relative_path_depth = $page_handler->relative_link_path(dirname(__FILE__));

$category = (!empty($_GET['category']) ? $_GET['category'] : $config->landing_directory);
$landing_page = (!empty($_GET['id']) ? $_GET['id'] : $config->landing_page);

$body_content = $page_handler->get_content($relative_path_depth, $category, $landing_page);

$x = $page_handler->get_content2($relative_path_depth, 'theone', '', '');

$page_handler->display_page($relative_path_depth, $x);

?>
