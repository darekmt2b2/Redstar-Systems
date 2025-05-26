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


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['delete_id'])) {
    $id = (int)$_POST['delete_id'];
    $sql = "DELETE FROM aircraft WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['add_aircraft'])) {
    $registration = $_POST['registration'];
    $type = $_POST['type'];
    $owner_id = (int)$_POST['owner_id'];

    $sql = "INSERT INTO aircraft (Registration, Type, ownerID) VALUES (?, ?, ?)";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssi", $registration, $type, $owner_id);
    $stmt->execute();

    header("Location: admin.php");
    exit();
}

$sql = "
    SELECT a.id, a.Registration, a.Type, u.name AS owner_name
    FROM aircraft a
    LEFT JOIN user u ON a.ownerID = u.id
";
$result = $conexion->query($sql);

// Output aircraft table
echo '
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Registration</th>
            <th>Type</th>
            <th>Owner</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>';
while ($row = $result->fetch_assoc()) {
    echo "
        <tr>
            <td>{$row['id']}</td>
            <td>" . htmlspecialchars($row['Registration']) . "</td>
            <td>" . htmlspecialchars($row['Type']) . "</td>
            <td>" . htmlspecialchars($row['owner_name'] ?? '—') . "</td>
            <td>
                <form method='POST'>
                    <input type='hidden' name='delete_id' value='{$row['id']}'>
                    <button type='submit'>Delete</button>
                </form>
            </td>
        </tr>
    ";
}
echo '</tbody></table>';
?>
