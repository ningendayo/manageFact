<?php
require_once 'db.php';
global $conn;
if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate inputs
    if ($password !== $confirm_password) {
        $error = 'Passwords do not match';
    } else {
        // Hash the password before storing it in the database
        $hashed_password = hash('SHA512', $password);

        // Replace the code below with your own database insertion logic
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        if (mysqli_query($conn, $sql)) {
            $message = 'User registered successfully';
        } else {
            $error = 'Error: ' . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
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
        input[type="email"],
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

        .success {
            color: green;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<h2>Formulario de Registro</h2>
<?php if (isset($error)) { ?>
    <p class="error"><?php echo $error; ?></p>
<?php } elseif (isset($message)) { ?>
    <p class="success"><?php echo $message; ?></p>
<?php } ?>
<form method="post" action="register.php">
    <label>Usuario:</label>
    <input type="text" name="username" required><br><br>
    <label>Email:</label>
    <input type="email" name="email" required><br><br>
    <label>Clave:</label>
    <input type="password" name="password" required><br><br>
    <label>Confirmar Clave:</label>
    <input type="password" name="confirm_password" required><br><br>
    <input type="submit" value="Registrarse">
    <div style="text-align:center"><small><a href="login.php">Iniciar Sesión</a></small></div>
</form>
</body>
</html>
