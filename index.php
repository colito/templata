<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('config/config.php');
require_once(APP_ROOT_DIR.'/includes/definitions.php');
require_once(T_SYSTEM.'page_handler.php');

$page_handler = new PageHandler();

$relative_path_depth = relative_path(dirname(__FILE__));

$path = get_current_uri(1);

if(!check_mod_rewrite())
{
    if(count($_GET) > 0)
    {
        if(!empty($_GET['category'])) {$path = get_base_url(). $_GET['category'];}
        if(!empty($_GET['article'])) {$path .= '/'. $_GET['article'];}
        if(!empty($_GET['sub-article'])) {$path .= '/'. $_GET['sub-article'];}
    }
}

$body_content = $page_handler->get_content($path);

$page_handler->display_page($relative_path_depth, $body_content);