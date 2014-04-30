<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('config.php');
require_once(T_FNS.'page_handler.php');

$config = new Config();
$page_handler = new PageHandler();

$relative_path_depth = relative_path(dirname(__FILE__)); //$page_handler->relative_link_path(dirname(__FILE__));

$category = (!empty($_GET['category']) ? $_GET['category'] : $config->default_landing_category);
$article = (!empty($_GET['article']) ? $_GET['article'] : $config->default_landing_article);
$sub_article = (!empty($_GET['sub-article']) ? $_GET['sub-article'] : $config->default_landing_sub_article);

$body_content = $page_handler->get_content($relative_path_depth, $category, $article, $sub_article);

$page_handler->display_page($relative_path_depth, $body_content);

