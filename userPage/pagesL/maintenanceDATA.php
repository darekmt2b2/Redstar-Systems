<?php
session_start();
include '../../guestpage/controller/bdconfig.php';

$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    die("Unauthorized access.");
    header("Location: ../../guestpage/pages/index.php");
}
header("Cache-Control: no-cache, no-store, must-revalidate"); 
header("Pragma: no-cache"); 
header("Expires: 0");

$sql = "SELECT 
            m.scheduleDate, 
            m.issue, 
            m.status, 
            p.Type AS plane_name
        FROM maintenance m
        JOIN aircraft p ON m.plane_id = p.ID
        WHERE m.user_id = ?";
        
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();

$result = $stmt->get_result();

echo "<div class='scroll-container'>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $statusText = match ($row['status']) {
            0 => "Pending",
            1 => "Ongoing",
            2 => "Finalized",
            default => "Unknown",
        };

        echo "<div class='event-card'>
                <p><strong>Plane:</strong> " . htmlspecialchars($row["plane_name"]) . "</p>
                <p><strong>Date:</strong> " . htmlspecialchars($row["scheduleDate"]) . "</p>
                <p><strong>Issue:</strong> " . nl2br(htmlspecialchars($row["issue"])) . "</p>
                <p><strong>Status:</strong> " . $statusText . "</p>
              </div>";
    }
} else {
    echo "<p>No maintenance records found.</p>";
}

echo "</div>";

$stmt->close();
$conexion->close();
?>
