<?php
// Start the session
session_start();

// Destroy the session
session_destroy();

// Redirect to login page or home page
header("Location: ../index.html");
exit();
?>
