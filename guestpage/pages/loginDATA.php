<?php
session_start();
include '../controller/bdconfig.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $easa = trim($_POST['EASA']);
    $password = $_POST['password'];

    $sql = "SELECT id, name, password, userType FROM user WHERE EASA = ?";
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
            $_SESSION['user_type'] = $user['userType']; 
            $userType = (int) $user['userType'];
            if ($userType === 2) {
                header("Location: ../../adminPage/pages/admin.php");
                exit();
            } elseif ($userType === 1) {
                header("Location: ../../userPage/pagesL/flightplan.php"); 
                exit();
            }

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
