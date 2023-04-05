<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css">
	<title>Height, Weight, Sex Form</title>
</head>
<body>

	<?php
	session_start();
	if (!isset($_SESSION['username'])) {
		header("Location: login.php");
		exit();
	}

	if ($_SESSION['user_type'] == 'admin') {
		// Display admin dashboard
		echo "<h2>Welcome, ".$_SESSION['username']." (Admin)</h2>";
	} else {
		// Display normal user dashboard
		echo "<h2>Welcome, ".$_SESSION['username']."</h2>";
	}
	?>

	<h2>Please enter your height, weight, and sex</h2>
	<form method="post" action="submit.php">
		<label>Height (in meters):</label><br>
		<input type="text" name="height" required><br>
		<label>Weight (in kilograms):</label><br>
		<input type="text" name="weight" required><br>
		<label>Sex:</label><br>
		<input type="radio" name="sex" value="male" required> Male<br>
  		<input type="radio" name="sex" value="female" required> Female<br><br>
  		<input type="submit" value="Submit">
    </form>
</body>
</html>