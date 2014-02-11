<?php

require_once('../../config.php');
require_once(APP_ROOT_DIR.'/fns/page_handler.php');
require_once(APP_ROOT_DIR.'/fns/file_handler.php');

$file_handler = new FileHandler();

$page_handler = new PageHandler();
$depth = $page_handler->relative_link_path(dirname(__FILE__));

//echo $file_handler->get_template_content();

$template_output = $page_handler->output_template('Test', $depth);
echo $template_output;
//var_dump($template_output);

?>
