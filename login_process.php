<?php
    require 'config.php';

    if (isset($_POST['login_username']) && isset($_POST['login_password'])) {
        $login_username = $_POST['login_username'];
        $login_password = $_POST['login_password'];

        $sql = "SELECT * FROM users WHERE username = '$login_username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($login_password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['user_type'] = $row['user_type'];
                header('Location: user-page.php');
                exit();
            } else {
                echo "Invalid password.";
            }
        } else {
            echo "Invalid username.";
        }
    }
