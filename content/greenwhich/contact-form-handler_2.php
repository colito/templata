<?php 
$errors = '';
$myemail = 'pride.mokhele@gmail.co.za';//<-----Put Your email address here.
if(empty($_POST['name'])  || 
   empty($_POST['mobile'])  || 
   empty($_POST['email']) || 
   empty($_POST['message']))
{
    $errors .= "\n Error: all fields are required";
}

$name = $_POST['name']; 
$mobile = $_POST['mobile'];
$email_address = $_POST['email']; 
$message = $_POST['message']; 








	$to = $myemail; 
	$email_subject = "Contact form submission: $name";
	$email_body = "You have received a new message.".
	"Here are the details:\n Name: $name \n Mobile: $mobile \n Email: $email_address \n Message \n $message"; 
	
	$headers = "From: $myemail\n"; 
	$headers .= "Reply-To: $email_address";
	
	mail($to,$email_subject,$email_body,$headers);
	//redirect to the 'thank you' page
	header('Location: thank_you.html');

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 
<html>
<head>
	<title>Greenwhich Institude Of Technology</title>
</head>

<body>
<!-- This page is displayed only if there is some error -->
<?php
echo nl2br($errors);
?>


</body>
</html>
