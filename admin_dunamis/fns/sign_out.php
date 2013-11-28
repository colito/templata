<?php
# start session
session_start();

# unset session variables
unset($_SESSION['admin_active']);

#destroy session
session_destroy();

# redirect user back to index page
header('Location: ../index.php');
?>