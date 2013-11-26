<?php
require_once('../fns/page_handler.php');

# Sets the header of the page.
# Class has already been instantiated in ../fns/page_handler.php as $page_handler
# Takes page name as parameter
$page_name = '{page_name}';
$page_handler->set_page_header($page_name);

?>

{content}

<?php
# sets the footer of the page
$page_handler->set_footer();
?>
