<?php
require_once('../config.php');
require_once(APP_ROOT_DIR.'/fns/page_handler.php');
require_once(APP_ROOT_DIR.'/fns/file_handler.php');

# Sets the header of the page.
# Class has already been instantiated in ../fns/page_handler.php as $page_handler
# Takes page name as parameter and the relative root for main navigation
$depth = $file_handler->relative_root(dirname(__FILE__));
$page_handler = new PageHandler();
$page_handler->set_page_header('Content', $depth);

?>

<!-- Content goes here. Body and container have already been included, continue from there. -->
<?php

$article_id = $_GET['article'];

if($article_id == 1)
{
    echo 'Here I am';
    require_once('construction/index.html');
}
elseif($article_id == 2)
{
    require_once('sample/index.php');
}
else{
    echo '<p>';
    echo 'Select an article';
    echo '<br>';
    echo '<a href="'.$depth.'article/1">Construction</a>';
    echo '<br>';
    echo '<a href="'.$depth.'article/2">Sample</a>';
    echo '</p>';
}

?>

<?php
# sets the footer of the page
$page_handler->set_page_footer();
?>
