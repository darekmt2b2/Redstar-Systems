<?php
session_start();
include '../controller/bdconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $easa = trim($_POST['EASA']);
    $password = $_POST['password'];

    $sql = "SELECT id, name, password FROM users WHERE EASA = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $easa);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['easa'] = $easa;

            header("Location: ../pages/dashboard.php"); // Redirect to user flightplans
            exit();
        } else {
            header("Location: ../pages/login.php?error=invalid_password");
            exit();
        }
    } else {
        header("Location: ../pages/login.php?error=user_not_found");
        exit();
    }
} else {
    echo "<p>Invalid request.</p>";
}
?>
