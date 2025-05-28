<?php
include '../../guestpage/controller/bdconfig.php';

$userId = $_SESSION['user_id'] ?? null;

if (!$userId) {
    die("Unauthorized access.");
    header("Location: ../../guestpage/pages/index.php");
}

// aprove maintenance
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['approve_id'])) {
    $id = (int)$_POST['approve_id'];
    $sql = "UPDATE maintenance SET status = 1 WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}


$sql = "
    SELECT 
    mr.id, 
    u.name AS user_name, 
    a.Registration AS aircraft_reg, 
    mr.scheduleDate, 
    mr.issue, 
    mr.status
    FROM maintenance mr
    JOIN user u ON mr.user_id = u.id
    JOIN aircraft a ON mr.plane_id = a.id
";
$result = $conexion->query($sql);

echo '
<h1>Maintenance Requests</h1>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>Registration</th>
            <th>Scheduled Date</th>
            <th>Issue</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>';
    
while ($row = $result->fetch_assoc()) {
    $statusText = $row['status'] == 1 ? "✅ Approved" : "⏳ Pending";
    $action = ($row['status'] == 0) ? '
        <form method="POST" style="display:inline;">
            <input type="hidden" name="approve_id" value="' . $row['id'] . '">
            <button type="submit">Approve</button>
        </form>' : '---';

    echo "
        <tr>
            <td>{$row['id']}</td>
            <td>" . htmlspecialchars($row['user_name']) . "</td>
            <td>{$row['aircraft_reg']}</td>
            <td>{$row['scheduleDate']}</td>
            <td>" . htmlspecialchars($row['issue']) . "</td>
            <td>$statusText</td>
            <td>$action</td>
        </tr>
    ";
}

echo '</tbody></table>';
?>
