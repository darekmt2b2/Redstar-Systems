<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../resources/css/events.css">
</head>
<body>
    <?php include '../pages/topnav.php'; ?>
    <?php include '../pages/eventsDATA.php'; ?> 
    
    <?php
    if (isset($_GET['already_registered']) && $_GET['already_registered'] == 'true') {
        echo '<script type="text/javascript">
            alert("You are already registered for this event.");
        </script>';
    }
    ?>

</body>
</html>