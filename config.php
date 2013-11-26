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

# navigation links
define('navi_home', '../home/');

# included file paths
define('main_include', '../includes/');
define('main_header', '../includes/header.php');
define('main_footer', '../includes/footer.php');

define('main_fns', '../fns/');

define('main_images', '../images/');
define('main_css', '../css/');
define('main_css_reset', '../css/normalize.css');
define('main_css_grid', '../css/grid.css');
define('main_css_style', '../css/style.css');
define('main_js', '../js/');
define('main_jquery', '../js/jquery-2.0.3.min.js');

?>