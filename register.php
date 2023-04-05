<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css">
    <title>Register Form</title>
</head>
<body>
    <?php
    if (isset($_POST['username']) && isset($_POST['password'])) {
        // Connect to MySQL database
        $conn = mysqli_connect("localhost", "username", "password", "database_name");
        
        // Escape user inputs for security
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        
        // Check if the username already exists
        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $query);
        
        if (mysqli_num_rows($result) > 0) {
            // Username already exists, show error message
            $error = "Username already exists, please choose a different one";
        } else {
            // Insert the new user into the database
            $query = "INSERT INTO users (username, password, user_type, height, weight, sex) VALUES ('$username', '$password', 'normal', 0, 0, 'male')";
            if (mysqli_query($conn, $query)) {
                // Registration successful, redirect to login page
                header("Location: login.php");
                exit();
            } else {
                // Error inserting user, show error message
                $error = "Error registering the user, please try again later";
            }
        }
    }
    ?>

    <div class="login">
        <form method="post">
            <label>Username:</label><br>
            <input type="text" name="username" required><br>
            <label>Password:</label><br>
            <input type="password" name="password" required><br><br>
            <input type="submit" value="Register">
        </form>
        <?php if (isset($error)) { echo $error; } ?>
    </div>
    

</body>
</html>