<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="../resources/css/login.css">
</head>
<body>
    <?php include '../pages/topnav.php'; ?>
    <div class="container">
        <div class="form-container">
            <h2>Login</h2>
            <form action="loginDATA.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>
        </div>
        <div class="logo-container">
            <img src="..\resources\img\redstarAW.png" alt="Logo">
        </div>
    </div>
</body>
</html>