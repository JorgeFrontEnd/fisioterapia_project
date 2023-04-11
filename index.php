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
                if($row['user_type'] == 'admin'){
                    header('Location: admin-page.php');
                } else {
                    header('Location: user-page.php');
                }
                exit();
            } else {
                 echo "<script>alert('Invalid username or password.');</script>";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css">
    <title>Login</title>
</head>
<body>
    <div class="form-pages">
        <form method="post">
        <label for="login_username">Username</label>
        <input type="text" name="login_username" id="login_username" required>
        <label for="login_password">Password</label>
        <input type="password" name="login_password" id="login_password" required>
        <a href="register.php">Registre-se aqui</a>
        <button type="submit">Login</button>
    </form>
    </div>

</body>
</html>
