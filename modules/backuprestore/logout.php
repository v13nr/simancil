<?php

session_start();

// If the user is logged in, unset the session
if (isset($_SESSION['basic_is_logged_in'])) {
   unset($_SESSION['basic_is_logged_in']);
}

// Now that the user is logged out, return to the login page
header('Location: login.php');
?>
