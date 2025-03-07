<?php 
include '../controller/bdconfig.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid event ID");
}

$id = $_GET['id'];

$sql = "SELECT Event_desc, date, name FROM events WHERE ID = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $event = $result->fetch_assoc();
    echo "<h2>" . htmlspecialchars($event['name']) . "</h2>";
    echo "<p><strong>Date:</strong> " . htmlspecialchars($event['date']) . "</p>";
    echo "<p>" . htmlspecialchars($event['Event_desc']) . "</p>";
} else {
    echo "<p>Event not found</p>";
}

// Display the reservation form correctly
echo "<div class='reservationForm'>
        <form action='../pages/reserve.php' method='post'>
            <label for='name'>Name:</label>
            <input type='text' id='name' name='name' required>

            <label for='email'>Email:</label>
            <input type='email' id='email' name='email' required>

            <input type='hidden' name='event_id' value='" . htmlspecialchars($id) . "'>

            <input type='submit' value='Reserve'>
        </form>
      </div>";

$stmt->close();
$conexion->close();
?>
