<?php
require_once('../../config.php');
require_once(T_FNS.'page_handler.php');

$config = new Config();
$page_handler = new PageHandler();

$page_title = 'Test';
$relative_path_depth = $page_handler->relative_link_path(dirname(__FILE__));

$query_string_array = explode('=', $_SERVER['QUERY_STRING']);

if(isset($_GET))
{
    $category =  $query_string_array[0];
    $landing_page = $query_string_array[1];
}
else
{
    echo 'Sorry';
    $category = $config->landing_directory;
    $landing_page = $config->landing_page;
}

$body_content = $page_handler->get_content($relative_path_depth, $category,$landing_page.'.php');

$page_handler->output_page($page_title, $relative_path_depth, $body_content);

?>
