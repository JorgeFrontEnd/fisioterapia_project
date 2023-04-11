<?php
   require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login_username = filter_input(INPUT_POST, 'login_username', FILTER_SANITIZE_STRING);
    $login_password = filter_input(INPUT_POST, 'login_password', FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM users WHERE username = '$login_username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($login_password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_type'] = $row['user_type'];
            if ($_SESSION['user_type'] === 'admin') {
                header('Location: admin-page.php');
            } else {
                header('Location: user-page.php');
            }
            exit();
        } else {
            $error_msg = "Invalid password.";
        }
    } else {
        $error_msg = "Invalid username.";
    }
}
?>
