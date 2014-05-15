[page:Page Error]

<?php
include_lib('page_handler');

$page_handler = new PageHandler();

if(!empty($_GET['article']))
{
    $_GET['article'] = (is_numeric($_GET['article']) ? $_GET['article'] : 0);
}
else
{
    $_GET['article'] = 0;
}

$error_type = $_GET['article'];
$x = $page_handler->set_page_name('Error ');

switch($error_type)
{
    case 0:
        $error_message = '<h2 class="error">Content not found</h2>';
        $page_handler->set_page_name('Error ' . $error_type);
        break;
    case 404:
        $error_message = '<h2 class="error">404: Oops! The page you were looking for doesn\'t seem to exist.</h2>';
        break;
    case 500:
        $error_message = '<h2 class="error">500: Server error.</h2>';
        break;
    default:
        $error_message = 'No error message for the current ID';
        break;
}

echo $error_message;