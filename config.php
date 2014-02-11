<?php
Class Config
{
    public $app_name = "Templata";
    public $user_name = '';
    public $password = '';
    public $right_click = 1; # disables right-click event on the site if set to 0. default = 1
    public $navigation_links = '/includes/nav_links.php';
}
?>


<?php

# define application root
define('APP_ROOT_DIR', dirname(__FILE__));

# coming soon...
//define('main_admin', '../admin_dunamis');

# include definitions
require_once(APP_ROOT_DIR.'/includes/definitions.php');

?>

