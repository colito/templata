<?php
require_once('../config.php');
class PageHandler
{
    public function set_page_header($page_name)
    {
        # $page_name is already in '../includes/header.php'
        return require_once(main_header);
    }

    public function set_footer()
    {
        return require_once(main_footer);
    }
}

$page_handler = new PageHandler();
?>