[page:Page Error]

<?php
require_once('content/constructor_kit.php');

$page_handler = new PageHandler();

if(!empty($_GET['category']))
{
    if(!empty($_GET['id']))
    {
        $_GET['id'] = (is_numeric($_GET['id']) ? $_GET['id'] : 0);
    }
    else
    {
        $_GET['id'] = 0;
    }

    $error_type = $_GET['id'];
    $x = $page_handler->set_page_name('Error ');

    switch($error_type)
    {
        case 0:
            $error_message = '';
            $page_handler->set_page_name('Error ' . $error_type);
            break;
        case 404:
            $error_message = '<h3>404: Oops! The page you were looking for doesn\'t seem to exist.</h3>';
            break;
        case 500:
            $error_message = '<h3>500: Server error.</h3>';
            break;
        default:
            $error_message = 'No error message for the current ID';
            break;
    }

    echo $error_message;
}