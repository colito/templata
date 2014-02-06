<?php
require_once('../config.php');
require_once(APP_ROOT_DIR.'/fns/page_handler.php');

# Sets the header of the page.
# Class has already been instantiated in ../fns/page_handler.php as $page_handler
# Takes page name as parameter and the relative root for main navigation
$page_handler = new PageHandler();
$depth = $page_handler->relative_link_path(dirname(__FILE__));
$page_handler->set_page_header('Home', $depth);

?>

<!-- Content goes here. Body and container have already been included, continue from there. -->
<?php
    $string = 'how to say hello';
    function create_slug($string){
        $slug=preg_replace('/[^A-Za-z0-9-]+/', '-', strtolower($string));
        return $slug;
    }
    echo create_slug('DOES THIS THING WORK OR NOT 100 2333 **56 ] {');
    //returns 'does-this-thing-work-or-not'
?>

<?php
# sets the footer of the page
//$page_handler->set_page_footer();
?>
