<?php
include 'config.php';

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM personas WHERE id = $id");
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $stmt = $conn->prepare("UPDATE personas SET nombre = ?, correo = ?, telefono = ? WHERE id = ?");
    $stmt->bind_param("sssi", $nombre, $correo, $telefono, $id);

    if ($stmt->execute()) {
        header('Location: index.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar persona</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        input { padding: 8px; width: 300px; margin-bottom: 10px; }
        .btn { padding: 10px 20px; background: #2196F3; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <h1>Editar persona</h1>
    <form method="POST">
        <label>Nombre:<br><input type="text" name="nombre" value="<?= $row['nombre'] ?>" required></label><br>
        <label>Correo:<br><input type="email" name="correo" value="<?= $row['correo'] ?>" required></label><br>
        <label>Teléfono:<br><input type="text" name="telefono" value="<?= $row['telefono'] ?>"></label><br><br>
        <input type="submit" value="Actualizar" class="btn">
        <a href="index.php">Cancelar</a>
    </form>

</body>
</html>
