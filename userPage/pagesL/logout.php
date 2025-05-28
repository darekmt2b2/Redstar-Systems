<?php
session_start();       
session_unset();       
session_destroy();     
header("Location: ../../guestpage/pages/index.php"); 
exit();                
?>
