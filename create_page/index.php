<?php
require_once('../fns/page_handler.php');
$page_handler->set_page_header('Create new page');

require_once(APP_ROOT_DIR.'/fns/file_handler.php');
$file_handler = new FileHandler();

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
