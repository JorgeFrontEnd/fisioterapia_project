<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="app.css">
    <title>Login form</title>
</head>

<body>

    <div class="form-pages">
        <form action="login_process.php" method="post">
            <label>Username:</label>
            <input type="text" id="login_username" name="login_username">
            <br>
            <label>Password:</label>
            <input type="password" id="login_password" name="login_password">
            <br>
            <a href="register.html">Registre-se aqui</a>
            <button id="login_button" type="submit">Login</button>
        </form>
    </div>

    <script src="app.js"></script>
</body>

</html>