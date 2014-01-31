<?php
require_once('../../config.php');
require_once(APP_ROOT_DIR.'/fns/page_handler.php');
require_once(APP_ROOT_DIR.'/fns/file_handler.php');

# Sets the header of the page.
# Class has already been instantiated in ../fns/page_handler.php as $page_handler
# Takes page name as parameter and the relative root for main navigation
$depth = $file_handler->relative_root(dirname(__FILE__));
$page_handler = new PageHandler();
$page_handler->set_page_header('Test', $depth);

?>

<!-- Content goes here. Body and container have already been included, continue from there. -->
<?php
//echo dirname(__FILE__);

//$create_page = $file_handler->relative_root(dirname(__FILE__)) . 'content';
//echo '<a href="'.$create_page.'">Create Page</a>';
echo 'Hello!!';

//var_dump($page_handler->navigation_menu($depth));
?>

<?php
# sets the footer of the page
//$page_handler->set_page_footer();
?>
