<?php
// Start the session
session_start();

// Destroy the session to log out the user
session_destroy();

// Redirect to the login page after logging out
header("Location: login.php");
exit();
?>
