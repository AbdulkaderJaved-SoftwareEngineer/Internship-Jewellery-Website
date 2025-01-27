<?php
session_start();
session_destroy(); // Destroy the session
header("Location: admin-login.php"); // Redirect to the home page
exit();
?>