<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $height = $_POST["height"];
    $weight = $_POST["weight"];
    $sex = $_POST["sex"];
    $user_type = "normal";

    $stmt = $conn->prepare("INSERT INTO users (username, password, user_type, height, weight, sex) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $username, $password, $user_type, $height, $weight, $sex);

    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
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
    <div class="form-pages">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            Username: <input type="text" name="username" required><br>
            Password: <input type="password" name="password" required><br>
            Height: <input type="number" name="height" step="0.01" required><br>
            Weight: <input type="number" name="weight" step="0.01" required><br>
            Sex: <select name="sex" required>
                <option value="">Select...</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select><br>
            <input type="submit" value="Register">
        </form>
    </div>

    <script src="app.js"></script>
</body>

</html>