<?php
require_once('../fns/page_handler.php');
require_once('../fns/file_handler.php');

# Sets the header of the page.
# Class has already been instantiated in ../fns/page_handler.php as $page_handler
# Takes page name as parameter
$page_handler->set_page_header('Home');

$content_path = 'sample/index.html';
//$content_path = 'sample/sample.php';
$content = $file_handler->get_content($content_path);

echo $content;

# sets the footer of the page
$page_handler->set_footer();
?>

