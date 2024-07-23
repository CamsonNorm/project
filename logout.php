<?php
session_start();
// Starting a session to access all sesion variables.
// Unset all of the session variables
// Clear all session varibales by asigning to an mepty array
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to home.html
header("Location: index.html");
exit();
?>
