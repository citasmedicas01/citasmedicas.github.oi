<?php
require 'config.php'; // Archivo de conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    
    // Verificar si el correo existe en la base de datos
    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $userId = $user['id'];
        
        // Generar un token único
        $token = bin2hex(random_bytes(50));
        
        // Guardar el token en la base de datos
        $stmt = $conn->prepare("INSERT INTO password_resets (user_id, token) VALUES (?, ?) ON DUPLICATE KEY UPDATE token = ?");
        $stmt->bind_param("iss", $userId, $token, $token);
        $stmt->execute();
        
        // Enviar el correo con el enlace de recuperación
        $resetLink = "http://tupagina.com/restablecer.php?token=" . $token;
        $subject = "Recuperación de contraseña";
        $message = "Haz clic en el siguiente enlace para restablecer tu contraseña: $resetLink";
        $headers = "From: no-reply@tupagina.com";
        
        if (mail($email, $subject, $message, $headers)) {
            echo "Revisa tu correo para restablecer la contraseña.";
        } else {
            echo "Error al enviar el correo.";
        }
    } else {
        echo "El correo no está registrado.";
    }
}
