<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css">
	<title>Login Form</title>
</head>
<body>

    <?php
    session_start();
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Connect to MySQL database
        $conn = mysqli_connect("localhost", "username", "password", "database_name");
        
        // Escape user inputs for security
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        
        // Query the database to check if the user exists
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) == 1) {
            // User is valid, set session variables and redirect to homepage
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['username'];
            $_SESSION['user_type'] = $row['user_type'];
            header("Location: fill-info.php");
            exit();
        } else {
            // Invalid username or password, show error message
            $error = "Invalid username or password";
        }
    }
    ?>

    <div class="login">
        <form method="post">
            <label>Username:</label><br>
            <input type="text" name="username" required><br>
            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>
            <span>Dont have an account? <a href="register.php"> Register here</a></span><br>
            <input type="submit" value="Login">
        </form>
	<?php if (isset($error)) { echo $error; } ?>
    </div>
	
	
</body>
</html>