<?php
include '../../guestpage/controller/bdconfig.php';

$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    header("Location: ../../guestpage/pages/index.php");
    exit;
}

header("Cache-Control: no-cache, no-store, must-revalidate"); 
header("Pragma: no-cache"); 
header("Expires: 0");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_id'])) {
    $id = (int)$_POST['delete_id'];
    $conexion->query("DELETE FROM events WHERE ID = $id");
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_event'])) {
    $desc = $_POST['event_desc'];
    $date = $_POST['event_date'];
    $name = $_POST['event_name'];

    $stmt = $conexion->prepare("INSERT INTO events (Event_desc, date, name) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $desc, $date, $name);
    $stmt->execute();
}


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['edit_event'])) {
    $id = (int)$_POST['event_id'];
    $desc = $_POST['event_desc'];
    $date = $_POST['event_date'];
    $name = $_POST['event_name'];

    $stmt = $conexion->prepare("UPDATE events SET Event_desc = ?, date = ?, name = ? WHERE ID = ?");
    $stmt->bind_param("sssi", $desc, $date, $name, $id);
    $stmt->execute();
}

$result = $conexion->query("SELECT * FROM events");

echo '<h1>Events</h1><button id="openAddEventBtn">Add Event</button>';
echo '<table>
<thead>
  <tr>
    <th>Name</th>
    <th>Date</th>
    <th>Description</th>
    <th>Action</th>
  </tr>
</thead>
<tbody>';

while ($row = $result->fetch_assoc()) {
    $shortDesc = strlen($row['Event_desc']) > 50 ? substr($row['Event_desc'], 0, 50) . '...' : $row['Event_desc'];
    echo "<tr>
      <td>" . htmlspecialchars($row['name']) . "</td>
      <td>" . htmlspecialchars($row['date']) . "</td>
      <td title=\"" . htmlspecialchars($row['Event_desc']) . "\">" . htmlspecialchars($shortDesc) . "</td>
      <td>
        <form method='POST' style='display:inline;'>
          <input type='hidden' name='delete_id' value='{$row['ID']}'>
          <button type='submit'>Delete</button>
        </form>
        <button class='openEditBtn' 
          data-id='{$row['ID']}' 
          data-name='" . htmlspecialchars($row['name'], ENT_QUOTES) . "' 
          data-desc=\"" . htmlspecialchars($row['Event_desc'], ENT_QUOTES) . "\" 
          data-date='{$row['date']}'>Edit</button>
      </td>
    </tr>";
}
echo '</tbody></table>';
?>
