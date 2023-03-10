<?php
require_once 'checkSession.php';
require_once 'db.php';
global $conn2;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize inputs
    $user_id = $_SESSION['id'];
    $title = htmlspecialchars($_POST["title"]);
    $page = intval($_POST['page']);
    $description = htmlspecialchars($_POST["description"]);

    // Prepare SQL statement to insert data into the table
    $sql = "INSERT INTO records (`type`,user_id, title, description) VALUES (?, ?, ?, ?)";
    $stmt = $conn2->prepare($sql);
    $stmt->bind_param("iiss", $page, $user_id, $title, $description);

    // Execute SQL statement and check for errors
    if ($stmt->execute()) {
        header("Location:protected.php?page=$page");
    } else {
        echo "Error: " . $sql . "<br>" . $conn2->error;
    }

    // Close SQL statement and database connection
    $stmt->close();
    $conn2->close();
    die();
} else {
    $page = $_GET['page'] ?? 1;
    $page = intval($page);
    $funcion = '';
    switch ($page) {
        case 1:
            $funcion = 'Soporte Técnico';
            break;
        case 2:
            $funcion = 'Talento Humano';
            break;
        case 3:
            $funcion = 'Ventas y Cobranzas';
            break;
        case 4:
            $funcion = 'Marketing';
            break;
        case 5:
            $funcion = 'Innovación';
            break;
        default:
            $funcion = 'asd';
    }
    $rs = $conn2->query("SELECT
        records.date,
        users.username,
        users.email,
        records.title,
        records.description
    FROM records
         INNER JOIN users ON users.id = records.user_id
         WHERE type='$page' ORDER BY `date` DESC");
    $data = $rs->fetch_all(MYSQLI_ASSOC);

}

?>
<style>
    label {
        display: block;
        margin-bottom: 10px;
    }

    input[type="text"], textarea {
        display: block;
        width: 100%;
        padding: 10px;
        margin-bottom: 20px;
        border: 2px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
        font-size: 16px;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    table {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    th {
        background-color: #007bff;
        color: #fff;
        text-align: left;
        padding: 12px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    td {
        padding: 12px;
    }
</style>
<h1><?= $funcion ?></h1>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="title">Titulo:</label>
    <input style="display: none" type="text" id="page" name="page" required value="<?= $page ?>">
    <input type="text" id="title" name="title" required>
    <label for="description">Descripción:</label>
    <textarea id="description" name="description" rows="4" required></textarea>
    <input type="submit" name="submit" value="Registrar">
</form>

<div style="margin-top: 50px">
    <h1>Registros Anteriores del Area</h1>
    <table>
        <thead>
        <tr>
            <th>Fecha</th>
            <th>Usuario</th>
            <th>Correo</th>
            <th>Titulo</th>
            <th>Descripción</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($data as $datum) {
            ?>
            <tr>
                <td><?= $datum['date'] ?></td>
                <td><?= $datum['username'] ?></td>
                <td><?= $datum['email'] ?></td>
                <td><?= $datum['title'] ?></td>
                <td><?= $datum['description'] ?></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>

</div>