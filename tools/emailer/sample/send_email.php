<?php
ob_start();

echo "Please wiat...";

$to_email = "pride.mokhele@gmail.com";

$subject = "Testing HTML embedded in email";

$from = "support@example.com";
$headers = "From:" . $from."\r\nContent-type: text/html";

$person_name = "James";

$full_message = file_get_contents('email.html');

$full_message = str_replace('{person_name}', $person_name, $full_message);

    mail($to_email, $subject, $full_message, $headers);

ob_flush();
?>