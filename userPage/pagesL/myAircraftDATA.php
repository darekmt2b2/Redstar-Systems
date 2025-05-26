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

$sql = "SELECT ID, Registration, Type FROM aircraft WHERE OwnerID = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();

$result = $stmt->get_result();

echo "<div class='scroll-container'>";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='event-card'>
                <p><strong>Registration:</strong> " . htmlspecialchars($row["Registration"]) . "</p>
                <p><strong>Type:</strong> " . htmlspecialchars($row["Type"]) . "</p>
                <a href='maintenanceRequest.php?id=" . htmlspecialchars($row["ID"]) . "' class='btn-view'>Request maintenance</a>
              </div>";
    }
} else {
    echo "<p>No aircraft found</p>";
}
echo "</div>";

$stmt->close();
$conexion->close();
?>