<?php
Class Config
{
    public $site_name = "Templata";

    public function file_root()
    {
        $root = $_SERVER['DOCUMENT_ROOT'];
        return $root;
    }
}

define('main_admin', '../admin_dunamis');

# navigation links
define('navi_home', '../home/');
define('navi_admin', 'main_admin');

# included file paths
define('main_include', '../includes/');
define('main_header', '../includes/header.php');
define('main_footer', '../includes/footer.php');

define('main_fns', '../fns/');

define('main_images', '../images/');
define('main_css', '../css/');
define('main_css_reset', '../css/reset.css');
define('main_css_normalize', '../css/normalize.css');
define('main_css_grid', '../css/grid.css');
define('main_css_style', '../css/style.css');
define('main_js', '../js/');
define('main_jquery', '../js/jquery-2.0.3.min.js');

?>