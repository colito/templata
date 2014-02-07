<?php
Class Config
{
    public $site_name = "Templata";
    public $user_name = '';
    public $password = '';
    public $right_click = 1; # disables right-click event on the site if set to 0
}
?>

<!--
            NAVIGATION LINKS

# All user links should be defined as follows:
# *Link Name:actual_link.file_extension
# This might be moved to a more appropriate location

*Home:home
*Create:create_page
*Content:article/
*Test:home/test

-->

<?php

# define application root
define('APP_ROOT_DIR', dirname(__FILE__));

# coming soon...
//define('main_admin', '../admin_dunamis');

# include definitions
require_once(APP_ROOT_DIR.'/includes/definitions.php');

?>

