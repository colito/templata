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
*Create:..admin/create_page
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

