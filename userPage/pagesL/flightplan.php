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
    <div class="firstrow">
        <div class="container">
            <div class="form-container">

                <h2>Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</h2>
                <p>Request your flight authorization below:</p>
                
                <form action="../pagesL/flightplanDATA.php" method="POST" enctype="multipart/form-data">
                    <label for="aircraft_registration">Aircraft registration:</label>
                    <input type="text" id="aircraft_registration" name="aircraft_registration" required>

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

        <div class="runway-map-container">
            <h3>Archerfield Airport – Runway Availability</h3>
            <svg id="runway-map" viewBox="0 0 800 300" width="100%" height="300" style="border:1px solid #ccc; background:#f8f8f8;">
                
                <rect id="runway-34L" x="100" y="120" width="600" height="20" fill="#ccc" stroke="#000" stroke-width="1">
                    <title>Runway 10R/28L status loading...</title>
                </rect>
                <text x="680" y="115" font-size="14" fill="#000">34L</text>

                
                <rect id="runway-34R" x="100" y="160" width="600" height="10" fill="#ccc" stroke="#000" stroke-width="1" stroke-dasharray="5,5">
                    <title>Runway 10L/28R status loading...</title>
                </rect>
                <text x="680" y="185" font-size="14" fill="#000">34R</text>
            </svg>

        </div>
    </div>
    <div class="metar-box" id="metar-data">
        <h3>Latest METAR Information:   </h3>
        <br>
        <p><?php include '../pagesL/flightplanDATA3.php'; ?></p>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        fetch('../pagesL/flightplanDATA2.php')
            .then(response => response.json())
            .then(data => {
                console.log("Runway data:", data); 
                for (const [runway, available] of Object.entries(data)) {
                    const element = document.getElementById(`runway-${runway}`);
                    if (element) {
                        element.setAttribute("fill", available == 1 ? "#5cb85c" : "#d9534f");

                        
                        let title = element.querySelector("title");
                        if (!title) {
                            title = document.createElementNS("http://www.w3.org/2000/svg", "title");
                            element.appendChild(title);
                        }
                        title.textContent = `Runway ${runway} is ${available == 1 ? "Available" : "Unavailable"}`;

                        
                        element.addEventListener("mouseover", () => {
                            element.style.cursor = "pointer";
                            element.setAttribute("opacity", "0.8");
                        });
                        element.addEventListener("mouseout", () => {
                            element.setAttribute("opacity", "1");
                        });
                    } else {
                        console.warn(`No element found for runway-${runway}`);
                    }
                }
            })
            .catch(err => console.error("Runway data error:", err));
        });

    </script>
    
    
</body>
</html> 
