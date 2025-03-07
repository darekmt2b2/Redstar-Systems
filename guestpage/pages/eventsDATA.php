<?php
include '../controller/bdconfig.php';

$sql = "SELECT ID, Event_desc, date, name FROM events ORDER BY date DESC";
$stmt = $conexion->prepare($sql);
$stmt->execute();

$result = $stmt->get_result();

echo "<div class='scroll-container'>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='event-card'>
                <h3>" . htmlspecialchars($row["name"]) . "</h3>
                <p><strong>Date:</strong> " . htmlspecialchars($row["date"]) . "</p>
                <p>" . htmlspecialchars($row["Event_desc"]) . "</p>
                <a href='event.php?id=" . htmlspecialchars($row["ID"]) . "' class='btn-reserve'>Reserve Now</a>
              </div>";
    }
} else {
    echo "<p>No planned events</p>";
}
echo "</div>";

$stmt->close();
$conexion->close();
?>