<?php
require_once 'db.php';
global $conn;
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = hash('SHA512', $_POST['password']);

    // Replace the code below with your own login validation logic

    $rs = mysqli_query($conn, "SELECT id,username,email FROM users WHERE username='$username' AND `password`='$password'") or mysqli_error($conn);
    $data = mysqli_fetch_all($rs, MYSQLI_ASSOC);
    if (count($data) > 0) {
        $record = $data[0];
        $_SESSION['id'] = $record['id'];
        $_SESSION['username'] = $record['username'];
        $_SESSION['email'] = $record['email'];
        header('Location: protected.php');
        exit();
    } else {
        // Display error message
        $error = 'Datos de Inicio de Sesión Invalidos';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Form</title>
    <style>
        body {
            background-color: #f2f2f2;
            font-family: Arial, sans-serif;
        }

        .container {
            margin: 50px auto;
            max-width: 500px;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: none;
            background-color: #f2f2f2;
            color: #333;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #333;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<h2>Inicio de Sesión</h2>
<form method="post" action="login.php">
    <?php if (isset($error)) { ?>
        <p class="error"><?php echo $error; ?></p>
    <?php } ?>
    <label>Username:</label>
    <input type="text" name="username" required><br><br>
    <label>Clave:</label>
    <input type="password" name="password" required><br><br>
    <input type="submit" value="Iniciar Sesión">
    <div style="text-align:center"><small><a href="register.php">Registrarse</a></small></div>
</form>
</body>
</html>