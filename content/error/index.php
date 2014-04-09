[page:Page Error]

<?php

if(!empty($_GET['category']))
{
    $error_type = (!empty($_GET['id']) ? $_GET['id'] : 0);

    switch($error_type)
    {
        case 0:
            $error_message = 'No message';
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