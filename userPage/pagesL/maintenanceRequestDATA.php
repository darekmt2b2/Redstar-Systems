<?php
session_start();
include '../../guestpage/controller/bdconfig.php';

$userId = $_SESSION["user_id"] ?? null;
if (!$userId) {
    die("Unauthorized access.");
    header("Location: ../../guestpage/pages/index.php");
}
header("Cache-Control: no-cache, no-store, must-revalidate"); 
header("Pragma: no-cache"); 
header("Expires: 0");



if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
            $date = $_POST['date'];
            $issue = $_POST['issue'];
            $userId = $_SESSION['user_id']; 
            $aircraftId = isset($_GET['id']) ? (int)$_GET['id'] : null;
            if (!$aircraftId) {
                die("Missing or invalid aircraft ID.");
            }


            $sql = "INSERT INTO maintenance (user_id, plane_id, scheduleDate, issue) VALUES (?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("iiss", $userId, $aircraftId, $date, $issue);


            if ($stmt->execute()) {
                echo "Maintenance request submitted successfully!";
                header("Location: flightplan.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $conexion->close();
        
} else {
    echo "Invalid request.";
}
?>