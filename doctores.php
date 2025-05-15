<?php
require 'config.php';

$sql = "SELECT id, nombre, especialidad, consultorio FROM usuarios WHERE tipo_usuario = 'doctor'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['nombre'] . "</td>
                <td>" . $row['especialidad'] . "</td>
                <td>" . $row['consultorio'] . "</td>
                <td><button class='button'>Editar</button><button class='button'>Eliminar</button></td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No hay doctores registrados</td></tr>";
}
?>
