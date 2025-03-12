<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up Page</title>
    <link rel="stylesheet" href="../resources/css/signin.css">
</head>
<body>
    <?php include '../pages/topnav.php'; ?>
    <div class="container">
        <div class="form-container">
            <h2>Sign Up</h2>
            <form action="../pages/signInDATA.php" method="POST">
                <div class="form-group">
                    <label for="name">Full Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="easa">EASA License Code:</label>
                    <input type="text" id="easa" name="easa" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="repeat_password">Repeat Password:</label>
                    <input type="password" id="repeat_password" name="repeat_password" required>
                </div>
                <button type="submit">Sign Up</button>
            </form>
            <p class="login-link">Already have an account? <a href="../pages/login.php">Log In</a></p>
        </div>
        <div class="logo-container">
            <img src="../resources/img/redstarAW.png" alt="Logo">
        </div>
    </div>
</body>
</html>
