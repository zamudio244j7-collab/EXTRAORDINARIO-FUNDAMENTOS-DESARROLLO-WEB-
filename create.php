<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];

    $stmt = $conn->prepare("INSERT INTO personas (nombre, correo, telefono) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $correo, $telefono);

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
    <title>Agregar persona</title>
    <style>
        body { font-family: Arial; margin: 30px; }
        input { padding: 8px; width: 300px; margin-bottom: 10px; }
        .btn { padding: 10px 20px; background: #4CAF50; color: white; border: none; cursor: pointer; }
    </style>
</head>
<body>

    <h1>Agregar persona</h1>
    <form method="POST">
        <label>Nombre:<br><input type="text" name="nombre" required></label><br>
        <label>Correo:<br><input type="email" name="correo" required></label><br>
        <label>Teléfono:<br><input type="text" name="telefono"></label><br><br>
        <input type="submit" value="Guardar" class="btn">
        <a href="index.php">Cancelar</a>
    </form>

</body>
</html>
