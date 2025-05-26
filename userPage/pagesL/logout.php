<?php
session_start();       // Start the session
session_unset();       // Unset all session variables
session_destroy();     // Destroy the session
header("Location: ../../guestpage/pages/index.php"); // Redirect to index.php
exit();                // Always exit after header redirects
?>
