<?php
# start session
session_start();

require_once('fns/user_handler.php');
$user_handler = new UserHandler();
$user_handler->logout();

?>