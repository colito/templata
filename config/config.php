<?php
Class Config
{
    # App name
    public $app_name = 'Templata';

    # Initial content to be displayed
    public $default_landing_path = 'theone';

    # DB
    public $host = 'localhost';
    public $user_name = 'root';
    public $password = '';
    public $database = '';

    # Right click bahaviour
    public $right_click = 1; # disables right-click event on the site if set to 0. default = 1

    # Template
    public $navigation_links = 'includes/links.php'; # this is relative within the actual template's root directory
    public $active_template = 'templata_basic';

    # Email
    public $email_to = 'somebody@somewhere.com';

    # Resources
    public $templata_content_directory = 'content';
    public $templata_images_directory = 'images';
    public $templata_libraries = 'libs';
    public $templata_jquey_path = 'libs/js/jquery';

}

# application root
require_once('root.php');
