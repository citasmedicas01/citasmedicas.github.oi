<?php
require 'config.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $tipoUsuario = $_POST['tipoUsuario'];
    $contrasena = $_POST['contrasena'];
    $fechaNacimiento = isset($_POST['fechaNacimiento']) ? $_POST['fechaNacimiento'] : null;
    $especialidad = isset($_POST['especialidad']) ? $_POST['especialidad'] : null;
    $consultorio = isset($_POST['consultorio']) ? $_POST['consultorio'] : null;

    $password_hash = password_hash($contrasena, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO usuarios (nombre, email, telefono, tipo_usuario, fecha_nacimiento, especialidad, consultorio, contrasena) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conn->error);
    }

    $stmt->bind_param("ssssssss", $nombre, $email, $telefono, $tipoUsuario, $fechaNacimiento, $especialidad, $consultorio, $password_hash);

    if ($stmt->execute()) {
        echo "<p>Usuario registrado correctamente. Serás redirigido en 3 segundos...</p>";
        echo "<script>
                setTimeout(function(){
                    window.location.href = 'iniciar.html';
                }, 3000);
              </script>";
        $stmt->close();
        $conn->close();
        exit();
    } else {
        echo "Error al registrar el usuario: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>
