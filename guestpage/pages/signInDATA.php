<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $easa = trim($_POST['easa']);
    $password = $_POST['password'];
    $repeat_password = $_POST['repeat_password'];
    $email = trim($_POST['email']);

    if ($password !== $repeat_password) {
        header("Location: ../pages/signup.php?error=password_mismatch");
        exit();
    }
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Db OPS
    include '../controller/bdconfig.php';

    $sql_check = "SELECT id FROM user WHERE mail = ?";
    $stmt = $conexion->prepare($sql_check);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        $sql_insert = "INSERT INTO user (name, EASA, password, mail, userType) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = $conexion->prepare($sql_insert);
        $stmt_insert->bind_param("ssssi", $name, $easa, $hashed_password, $email, 1);
        $stmt_insert->execute();

        header("Location: ../pages/login.php?signup_success=true");
        exit();
    } else {
        header("Location: ../pages/signup.php?error=user_exists");
        exit();
    }
} else {
    echo "<p>Invalid request.</p>";
}
?>
