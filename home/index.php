<?php
require_once('../fns/page_handler.php');
require_once(APP_ROOT_DIR.'/fns/file_handler.php');

# Sets the header of the page.
# Class has already been instantiated in ../fns/page_handler.php as $page_handler
# Takes page name as parameter
$page_handler->set_page_header('Home');

?>

<!-- Content goes here. Body and container have already been included, continue from there. -->

<?php
# sets the footer of the page
$page_handler->set_footer();
?>
