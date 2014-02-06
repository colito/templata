<?php
require_once('../config.php');
require_once(APP_ROOT_DIR.'/fns/page_handler.php');
require_once(APP_ROOT_DIR.'/fns/file_handler.php');

# Sets the header of the page.
# Class has already been instantiated in ../fns/page_handler.php as $page_handler
# Takes page name as parameter and the relative root for main navigation
$page_handler = new PageHandler();
$depth = $page_handler->relative_link_path(dirname(__FILE__));
$page_handler->set_page_header('Creat Page', $depth);

$new_file_content = $file_handler->get_template_content();
$new_file_content = str_replace('{page_name}', 'Page Name', $new_file_content);
$new_file_content = str_replace('{content}', 'Hello World', $new_file_content);

//var_dump($new_file_content);

//$fp = fopen('data.txt', 'w');
//$string = 'This is my test string';
//$result = $file_handler->fwrite_stream($fp, $string);

//$file_handler->create_new_page('ex/one/two/hello2.php');

//$basePath = dirname(__FILE__);
//var_dump($basePath);

?>
<!--
<div id="content">
    <h2>Create Page</h2>
    <br>
    <p>Page name: <input type="text" name="new_page"></p>
</div>
-->
<?php $page_handler->set_page_footer(); ?>
