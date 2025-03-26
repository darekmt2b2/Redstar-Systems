<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flight Authorization</title>
    <link rel="stylesheet" href="..\resources\flightplan.css"> 
</head>
<body>
    <?php include '../pagesL/logguedTopnav.php';?>

    <div class="container">
        <div class="form-container">

            <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
            <p>Request your flight authorization below:</p>
            
            <form action="../pages/flightplanDATA.php" method="POST" enctype="multipart/form-data">
                <label for="aircraft_id">Aircraft registration:</label>
                <input type="number" id="aircraft_id" name="aircraft_id" required>

                <label for="date">Flight Date:</label>
                <input type="date" id="date" name="date" required>

                <label for="departure">Departure Airport:</label>
                <input type="text" id="departure" name="departure" required>

                <label for="departure_runway">Departure Runway (ID):</label>
                <input type="number" id="departure_runway" name="departure_runway" required>

                <label for="arrival">Arrival Airport:</label>
                <input type="text" id="arrival" name="arrival" required>

                <label for="flightplan">Upload Flight Plan (JSON):</label>
                <input type="file" name="flightplan" id="flightplan" accept=".json" required>

                <button type="submit">Request Authorization</button>
            </form>
        </div>
    </div>
    

    <!--
    <button onclick="window.location.href='../pagesL/flight.php'">View Flight Requests</button>

    <a href="logout.php">Logout</a>
        -->
</body>
</html> 
