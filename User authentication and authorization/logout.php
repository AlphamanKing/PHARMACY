<?php
// logout.php

// Start the session (if not already started)
session_start();

// Clear session data (user ID, name, etc.)
unset($_SESSION['id']);
unset($_SESSION['name']);

// Redirect to the login page after logout
header('Location: login.php');
exit;
?>
