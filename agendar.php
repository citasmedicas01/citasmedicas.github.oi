<?php
require 'config.php'; // Asegúrate de tener config.php con la conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $fecha = $_POST['fecha'];
    $especialidad = $_POST['especialidad'];

    $stmt = $conn->prepare("INSERT INTO citas (nombre, fecha, especialidad) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Error en la preparación: " . $conn->error);
    }

    $stmt->bind_param("sss", $nombre, $fecha, $especialidad);

    if ($stmt->execute()) {
        echo "Cita registrada correctamente.";
    } else {
        echo "Error al registrar la cita: " . $stmt->error;
    }

    $stmt->close();
}
?>
