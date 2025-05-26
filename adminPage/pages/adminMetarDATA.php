<?php
include '../../guestpage/controller/bdconfig.php';

$userId = $_SESSION['user_id'] ?? null;
if (!$userId) {
    die("Unauthorized access.");
    header("Location: ../../guestpage/pages/index.php");
}


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['metar_data'])) {
    $newMetar = $_POST['metar_data'];
    $stmt = $conexion->prepare("UPDATE metar SET METARDATA = ? LIMIT 1");
    $stmt->bind_param("s", $newMetar);
    $stmt->execute();
}


$result = $conexion->query("SELECT METARDATA FROM metar LIMIT 1");
$metar = $result->fetch_assoc()['METARDATA'] ?? '';

?>

<form method="POST">
  <label for="metar_data">Current METAR:</label><br>
  <textarea name="metar_data" id="metar_data" rows="5" style="width: 100%;" required><?php echo htmlspecialchars($metar); ?></textarea>
  <br><br>
  <button type="submit">Update METAR</button>
</form>
