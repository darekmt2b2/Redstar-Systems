<?php
session_start();
include '../../guestpage/controller/bdconfig.php';

$userId = $_SESSION["user_id"] ?? null;
if (!$userId) {
    die("Unauthorized access.");
    header("Location: ../../guestpage/pages/index.php");
}
header("Cache-Control: no-cache, no-store, must-revalidate"); 
header("Pragma: no-cache"); 
header("Expires: 0");

// Fetch the latest flight plan
$flightId = $_GET['id'] ?? null;

if (!is_numeric($flightId)) {
    die("Invalid flight ID.");
}

$sql = "SELECT FLJSON FROM flightplan WHERE UserID = ? AND ID = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ii", $userId, $flightId);
$stmt->execute();
$result = $stmt->get_result();

$flightPlan = [];
if ($row = $result->fetch_assoc()) {
    $flightPlan = json_decode($row["FLJSON"], true);
}

//error handling
if (empty($flightPlan)) {
    echo "<p>No flight plan found.</p>";
    return;
}
?>


<!-- Leaflet CSS & JS  V3.5-->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>

<style>
    #map {
        width: 100%;
        height: 600px;
    }
</style>

<script>
    let flightPlan = <?php echo json_encode($flightPlan); ?>; //turns json into an array 

    function initMap() {
        if (!flightPlan.length) {
            console.error("No flight data available.");
            return;
        }

        let map = L.map('map').setView([flightPlan[0].lat, flightPlan[0].lon], 6);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        let flightPath = [];
        
        flightPlan.forEach(point => {
            let position = [point.lat, point.lon];
            flightPath.push(position);

            L.marker(position)
                .addTo(map)
                .bindPopup(`<b>${point.ident} (${point.type})</b><br>Altitude: ${point.alt} ft`)
                .openPopup();
        });

        L.polyline(flightPath, { color: 'red' }).addTo(map); //draws the line using polyline
    }

    document.addEventListener("DOMContentLoaded", initMap);
</script>
