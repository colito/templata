<?php
Class Config
{
    public $site_name = "Templata";
}
?>

<!--
            NAVIGATION LINKS

# All user links should be defined as follows:
# *Link Name:actual_link.file_extension

*Home:home
*Create:create_page
*Content:content
*Test:home/test

-->

<?php
# DEFINITIONS ***********************************************************************/

define('APP_ROOT_DIR', dirname(__FILE__));

define('main_admin', '../admin_dunamis');


# navigation links *******************************************/
# now replaced by navigation links above
define('navi_home', 'home');
define('navi_admin', main_admin);


# included file paths ***************************************/

define('main_content', APP_ROOT_DIR.'/content');

define('main_include', APP_ROOT_DIR.'/includes/');
define('main_header', APP_ROOT_DIR.'/includes/header.php');
define('main_footer', APP_ROOT_DIR.'/includes/footer.php');

define('main_fns', APP_ROOT_DIR.'/fns/');

define('main_images', '/images/');
define('main_css', '/css/');
define('main_css_reset', '/css/reset.css');
define('main_css_normalize', '/css/normalize.css');
define('main_css_grid', '/css/grid.css');
define('main_css_style', '/css/style.css');
define('main_js', '/js/');
define('main_jquery', '/js/jquery-2.0.3.min.js');

?>

