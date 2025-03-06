<?php
include '../controller/bdconfig.php';

$sql = "SELECT ID, Event_desc, date, name FROM events ORDER BY date DESC";
$result = $conexion->query($sql);

echo "<div class='scroll-container'>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        // Each event card now links to reservation.php with the event ID
        echo "<div class='event-card'>
                <h3>" . $row["name"] . "</h3>
                <p><strong>Date:</strong> " . $row["date"] . "</p>
                <p>" . $row["Event_desc"] . "</p>
                <a href='reservation.php?id=" . $row["ID"] . "' class='btn-reserve'>Reserve Now</a>
              </div>";
    }
} else {
    echo "<p>No events found</p>";
}
echo "</div>";

$conexion->close();
?>

