<?php
$page_name = 'Contact Us';
$contact_active_page = 'active_page';
require_once('../includes/header.php');
?>

    <div id='content' class='grid_5 omega'>
        <h2>Contact Us</h2>
        <p>Drop us a mail. We'd like to hear from you</p>
        <br/>
        <p>
            <img src='../../../img/theone/images/mail.gif' width='260' height='160' />
        </p>
        <br/>
        <p>
            Nulla elementum dui ut augue. Aliquam vehicula mi at mauris. Maecenas
            placerat, nisl at consequat rhoncus, sem nunc gravida justo, quis eleifend
            arcu velit quis lacus.
        </p>
    </div>

    <div id='form' class='grid_7 omega'>
        <form action='../includes/contact_validation.php' method='post'>
            <dl>
                <dt>
                <dd><label for='name'>Name:</label></dd>
                <dd>
                    <input name='name' id='name' type='text'>
                    <span>Please enter your name</span>
                </dd>
                </dt>
                <dt>
                <dd><label for='email'>Email:</label></dd>
                <dd>
                    <input name='email' id='email' type='text' class='required'>
                    <span>Enter a valid email address</span>
                </dd>
                </dt>
                <dt>
                <dd><label for='subject'>Subject:</label></dd>
                <dd><input name='subject' id='subject' type='text'>
                    <span>Please enter your subject</span>
                </dd>
                </dt>
                <dt>
                <dd><label for='message'>Message:</label></dd>
                <dd>
                    <textarea rows='8' name='message' id='message' class='required'></textarea>
                    <span>Please enter your message</span>
                </dd>
                </dt>
                <dt>
                <dd class='submit'>
                    <input type='submit' value='Submit' class='btn-submit'>
                </dd>
                </dt>
            </dl>

            <?php
            if(isset($_GET['feedback']))	{
                $feedback = $_GET['feedback'];
            }
            else	{
                $feedback = "";
            }
            ?>
            <p class='feedback'><?php echo $feedback; ?></p>
        </form>
    </div>

<?php require_once('../includes/validate_email.php'); ?>

<?php require_once('../includes/footer.php') ?>