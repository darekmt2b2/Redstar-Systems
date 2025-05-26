<?php
session_start();
include '../../guestpage/controller/bdconfig.php';

$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    die("Unauthorized access.");
}

header("Cache-Control: no-cache, no-store, must-revalidate"); 
header("Pragma: no-cache"); 
header("Expires: 0");

// Fetch only the logged-in user's flight plans
$sql = "SELECT ID, Departure, Arrival, date FROM flightplan WHERE UserID = ? ORDER BY date DESC";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($flightplan = $result->fetch_assoc()) {
        echo "
                <h2>Flight Details</h2>
                <p><strong>Date:</strong> " . htmlspecialchars($flightplan["date"]) . "</p>
                <p><strong>Departure:</strong> " . htmlspecialchars($flightplan["Departure"]) . "</p>
                <p><strong>Arrival:</strong> " . htmlspecialchars($flightplan["Arrival"]) . "</p>
            ";
    }
} else {
    echo "<p>No flight plans available</p>";
}

$stmt->close();
$conexion->close();
?>