<?php
session_start();
include '../../guestpage/controller/bdconfig.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
header("Cache-Control: no-cache, no-store, must-revalidate"); 
header("Pragma: no-cache"); 
header("Expires: 0");

$sql = "SELECT name, availability FROM airfield";
$result = $conn->query($sql);

$runways = [];
while ($row = $result->fetch_assoc()) {
    $runways[$row['name']] = $row['availability'];
}

echo json_encode($runways);
?>