<?php
include '../../guestpage/controller/bdconfig.php';

$userId = $_SESSION["user_id"] ?? null;
if (!$userId) {
    die("Unauthorized access.");
    header("Location: ../../guestpage/pages/index.php");
}

header("Cache-Control: no-cache, no-store, must-revalidate"); 
header("Pragma: no-cache"); 
header("Expires: 0");


$sql = "SELECT METARDATA FROM metar WHERE ID=1";
$result = $conexion->query($sql);

$metar = null;
if ($result && $row = $result->fetch_assoc()) {
    echo htmlspecialchars($row['METARDATA']);
    
} else {
    $metar = "No METAR data available.";
}
?>