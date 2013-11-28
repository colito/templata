<?php
require_once('../fns/page_handler.php');

# Sets the header of the page.
# Class has already been instantiated in ../fns/page_handler.php as $page_handler
# Takes page name as parameter
$page_handler->set_page_header('Home');


//echo basename('etc/one/page.php');
//echo dirname('etc/one/page.php');
?>

<!-- Content within div container class goes in here -->

<?php
# sets the footer of the page
$page_handler->set_footer();
?>
