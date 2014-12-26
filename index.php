<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('config.php');
require_once(APP_ROOT_DIR.'/includes/definitions.php');
require_once(T_SYSTEM.'page_handler.php');

$config = new Config();
$page_handler = new PageHandler();

$relative_path_depth = relative_path(dirname(__FILE__));

$uri = get_current_uri(1);

$body_content = $page_handler->get_content($uri);

$page_handler->display_page($relative_path_depth, $body_content);