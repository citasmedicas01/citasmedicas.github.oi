<?php
require 'config.php';

$sql = "SELECT id, nombre, fecha_nacimiento, especialidad FROM usuarios WHERE tipo_usuario = 'paciente'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row['id'] . "</td>
                <td>" . $row['nombre'] . "</td>
                <td>" . $row['fecha_nacimiento'] . "</td>
                <td>" . $row['especialidad'] . "</td>
                <td><button class='button'>Editar</button><button class='button'>Eliminar</button></td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='5'>No hay pacientes registrados</td></tr>";
}
?>
