<?php
session_start();
include '../../guestpage/controller/bdconfig.php';

$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    die("Unauthorized access.");
}

// Fetch only the logged-in user's flight plans
$sql = "SELECT ID, Departure, Arrival, date FROM flightplan WHERE UserID = ? ORDER BY date DESC";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();

$result = $stmt->get_result();

echo "<div class='scroll-container'>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='event-card'>
                <h3>Flight Plan #" . htmlspecialchars($row["ID"]) . "</h3>
                <p><strong>Date:</strong> " . htmlspecialchars($row["date"]) . "</p>
                <p><strong>Departure:</strong> " . htmlspecialchars($row["Departure"]) . "</p>
                <p><strong>Arrival:</strong> " . htmlspecialchars($row["Arrival"]) . "</p>
                <a href='flight.php?id=" . htmlspecialchars($row["ID"]) . "' class='btn-view'>View Details</a>
              </div>";
    }
} else {
    echo "<p>No flight plans available</p>";
}
echo "</div>";

$stmt->close();
$conexion->close();
?>
