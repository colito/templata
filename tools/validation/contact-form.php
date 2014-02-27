<?php
ob_start();
require_once('../../config.php');

$config = new Config();

echo 'Please wiat...';

$to_email = $config->email_to;

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$subject = '[Contact Form] ' . $_POST['subject'];


function isValidEmail($email) {
    return strpos($email, '@') !== false;
}

/*function isPostBack() {
    return ($_SERVER['REQUEST_METHOD'] == 'POST');
}*/

if($email != '' && $message != '' && isValidEmail($email)) {

    $full_message = "Name : \t\t". $name . "\n";
    $full_message .= "Email : \t\t". $email . "\n\n";
    $full_message .= $message . "\n";

    mail($to_email, $subject, $full_message);

    //echo "<input type='hidden' name='feedback' value='Your form has been successfully submitted.' >";

    $feedback = 'Your form has really been successfully submitted.';

    $feedback = urlencode($feedback);

    $contact_form = $_SERVER['HTTP_REFERER'];

    header('location: '.$contact_form.'&validation-feedback=' . $feedback);

    exit();
}

die('Your data is invalid.');

ob_flush();
?>