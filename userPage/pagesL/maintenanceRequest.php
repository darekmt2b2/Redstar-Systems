<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
header("Cache-Control: no-cache, no-store, must-revalidate"); 
header("Pragma: no-cache"); 
header("Expires: 0");
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
            <p>Describe your maintenance request above:</p>
            
            <form action="../pagesL/maintenanceRequestDATA.php?id=<?php echo $_GET['id']; ?>" method="POST" enctype="multipart/form-data">

                <label for="date">Schedule a Date:</label>
                <input type="date" id="date" name="date" required>

                <label for="departure">Issue:</label>
                <textarea name="issue" id="issue" rows="4" cols="50" placeholder="Write your message here..."></textarea>


                <button type="submit">Request maintenance</button>
            </form>
        </div>
    </div>
    
</body>
</html> 
