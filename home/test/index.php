<?php
require_once('../../config.php');
require_once(T_FNS.'page_handler.php');

$config = new Config();
$page_handler = new PageHandler();

$relative_path_depth = $page_handler->relative_link_path(dirname(__FILE__));

if(!empty($_GET))
{
    $category =  $_GET['category'];
    $landing_page = $_GET['id'];
}
else
{
    $category = $config->landing_directory;
    $landing_page = $config->landing_page;
}


$body_content = $page_handler->get_content($relative_path_depth, $category,$landing_page.'.php');

$page_handler->output_page($relative_path_depth, $body_content);

?>
