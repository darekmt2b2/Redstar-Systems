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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["flightplan"]) && $_FILES["flightplan"]["error"] == 0) {
        $fileTmpPath = $_FILES["flightplan"]["tmp_name"];
        $fileType = $_FILES["flightplan"]["type"];

        if ($fileType == "application/json") {
            $jsonData = file_get_contents($fileTmpPath);
            $flightPlan = json_decode($jsonData, true);

            if ($flightPlan === null) {
                die("Invalid JSON file.");
            }

            $registration = $_POST['aircraft_registration'];
            $date = $_POST['date'];
            $departure = trim($_POST['departure']);
            $departureRunway = $_POST['departure_runway'];
            $arrival = trim($_POST['arrival']);
            $userId = $_SESSION['user_id']; 
            $status = 0; 
            
            $sqlAircraft = "SELECT ID FROM aircraft WHERE Registration = ?";
            $stmtAircraft = $conexion->prepare($sqlAircraft);
            $stmtAircraft->bind_param("s", $registration);
            $stmtAircraft->execute();
            $stmtAircraft->bind_result($aircraftId);
            $stmtAircraft->fetch();
            $stmtAircraft->close();

            $sql = "INSERT INTO flightplan (Aircraft_ID, UserID, date, Departure, departureRunway, Arrival, FLJSON, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("iississi", $aircraftId, $userId, $date, $departure, $departureRunway, $arrival, $jsonData, $status);

            if ($stmt->execute()) {
                echo "Flight request submitted successfully!";
                header("Location: flightplan.php");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $conexion->close();
        } else {
            echo "Invalid file type. Please upload a valid JSON file.";
        }
    } else {
        echo "File upload error!";
    }
} else {
    echo "Invalid request.";
}
?>
