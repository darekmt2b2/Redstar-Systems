<?php
session_start();
include '../../guestpage/controller/bdconfig.php';
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["flightplan"]) && $_FILES["flightplan"]["error"] == 0) {
        $fileTmpPath = $_FILES["flightplan"]["tmp_name"];
        $fileType = $_FILES["flightplan"]["type"];

        // Validate file type
        if ($fileType == "application/json") {
            $jsonData = file_get_contents($fileTmpPath);
            $flightPlan = json_decode($jsonData, true);

            if ($flightPlan === null) {
                die("Invalid JSON file.");
            }

            // Retrieve form data
            $aircraftId = $_POST['aircraft_id'];
            $date = $_POST['date'];
            $departure = trim($_POST['departure']);
            $departureRunway = $_POST['departure_runway'];
            $arrival = trim($_POST['arrival']);
            $userId = $_SESSION['user_id']; 
            $status = 0; 

            $sql = "INSERT INTO flightplan (Aircraft_ID, UserID, date, Departure, departureRunway, Arrival, FLJSON, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("iississi", $aircraftId, $userId, $date, $departure, $departureRunway, $arrival, $jsonData, $status);

            if ($stmt->execute()) {
                echo "Flight request submitted successfully!";
                header("Location: flightRequests.php");
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
