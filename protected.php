<?php
require_once 'checkSession.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard with Navbar</title>
    <!-- Custom CSS -->
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        .navbar {
            background-color: #343a40;
            color: #fff;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
        }

        .navbar-brand {
            font-size: 24px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .navbar-links ul {
            margin: 0;
            padding: 0;
            list-style: none;
            display: flex;
            align-items: center;
        }

        .navbar-links li {
            margin-left: 20px;
        }

        .navbar-links a {
            color: #fff;
            text-decoration: none;
            font-size: 18px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            font-size: 36px;
            margin-top: 0;
        }

        p {
            font-size: 18px;
            line-height: 1.5;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<div class="navbar">
    <div class="navbar-brand">Hola <?= $_SESSION['username'] ?></div>
    <div class="navbar-links">
        <ul>
            <li><a href="protected.php?page=1">Soporte Tecnico</a></li>
            <li><a href="protected.php?page=2">Talento Humano</a></li>
            <li><a href="protected.php?page=3">Ventas y Cobranzas</a></li>
            <li><a href="protected.php?page=4">Marketing</a></li>
            <li><a href="protected.php?page=5">Innovación</a></li>
            <li><a href="logout.php">Cerrar Sesión</a></li>
        </ul>
    </div>
</div>

<!-- Main Content -->
<div class="container" id="container">

</div>

<script>
    function loadHTML(url, divId = 'container') {
        fetch(url)
            .then(response => {
                if (response.ok) {
                    return response.text();
                }
                throw new Error('Network response was not ok.');
            })
            .then(data => {
                document.getElementById(divId).innerHTML = data;
            })
            .catch(error => {
                console.error('There was a problem fetching the HTML:', error);
            });
    }
    <?php
    $page = $_GET['page'] ?? 1;
    ?>
    loadHTML('contenido.php?page=<?=$page?>');
    <?php
    ?>
</script>

</body>
</html>
