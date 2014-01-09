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

*Home:../home
*Create:../admin/create_page
*Content:../content

-->

<?php
# DEFINITIONS ***********************************************************************/

define('APP_ROOT_DIR', dirname(__FILE__));

define('main_admin', '../admin_dunamis');


# navigation links *******************************************/
# now replaced by navigation links above
define('navi_home', '../home/');
define('navi_admin', main_admin);


# included file paths ***************************************/

define('main_content', '../content');

define('main_include', '../soul/includes/');
define('main_header', '../soul/includes/header.php');
define('main_footer', '../soul/includes/footer.php');

define('main_fns', '../soul/fns/');

define('main_images', '../img/');
define('main_css', '../soul/css/');
define('main_css_reset', '../soul/css/reset.css');
define('main_css_normalize', '../soul/css/normalize.css');
define('main_css_grid', '../soul/css/grid.css');
define('main_css_style', '../soul/css/style.css');
define('main_js', '../soul/js/');
define('main_jquery', '../soul/js/jquery-2.0.3.min.js');

?>

