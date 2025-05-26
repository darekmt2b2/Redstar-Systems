<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="..\resources\flight.css"> 
</head>
<body>
    <?php include '../pagesL/logguedTopnav.php';?>
    

    <div class="container">
        <div class="card">
            <?php include '../pagesL/flightDATA2.php'; ?>
        </div>

        <div class="map-container">
            <div id="map">
                <?php include '../pagesL/flightDATA.php'; ?>
            </div>
        </div>
    </div>

</body>
</html>