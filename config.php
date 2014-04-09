<?php
Class Config
{
    public $app_name = '';
    public $landing_directory = 'theone';
    public $landing_page = 'index';
    public $user_name = '';
    public $password = '';
    public $right_click = 1; # disables right-click event on the site if set to 0. default = 1
    public $navigation_links = 'includes/nav_links.php'; # this is relative within the actual template's root directory
    public $active_template = 'templata_basic';
    //public $active_template = 'theone';
    public $email_to = 'somebody@somewhere.com';

    public $templata_content_directory = 'content';
    public $templata_images_directory = 'images';

    # resources
    public $templata_libraries = 'libs';
    public $templata_jquey_path = 'libs/js/jquery';

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

