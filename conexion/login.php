<?php
include 'conexion.php';

// Establecer encabezado para la respuesta como JSON
header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Obtener los datos del cuerpo de la solicitud JSON
    $input = json_decode(file_get_contents('php://input'), true);

    // Asegurarse de que se recibieron los datos correctamente
    if (isset($input['correo']) && isset($input['contraseña'])) {
        $correo = $input['correo'];
        $contraseña = $input['contraseña'];

        // Preparar la consulta para seleccionar id, nombre, apellidos, correo, contraseña, rol y usuario
        $sql = "SELECT id, nombre, apellidos, correo, contraseña, rol, usuario FROM usuarios WHERE correo = ?";
        $stmt = $conn->prepare($sql);

        // Verificar si la preparación fue exitosa
        if ($stmt === false) {
            echo json_encode(["success" => false, "message" => "Error al preparar la consulta: " . $conn->error]);
            exit;
        }

        // Vincular los parámetros
        $stmt->bind_param("s", $correo);  // "s" indica que el parámetro es una cadena

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener el resultado
        $result = $stmt->get_result();

        // Verificar si se encontró un usuario
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();  // No pasa ningún parámetro aquí

            // Verificar la contraseña
            if (password_verify($contraseña, $row['contraseña'])) {
                // Devolver respuesta en JSON con los datos del usuario y su rol
                echo json_encode([
                    "success" => true,
                    "usuario" => [
                        "id" => $row['id'],
                        "nombre" => $row['nombre'],
                        "usuario" => $row['usuario'],
                        "apellidos" => $row['apellidos'],
                        "correo" => $row['correo'],
                        "rol" => $row['rol'],
                    ],
                ]);
            } else {
                echo json_encode(["success" => false, "message" => "Contraseña incorrecta"]);
            }
        } else {
            echo json_encode(["success" => false, "message" => "No se encontró el usuario"]);
        }

        // Cerrar la declaración
        $stmt->close();

    } else {
        echo json_encode(["success" => false, "message" => "Correo y contraseña son necesarios"]);
    }

    // Cerrar la conexión
    $conn->close();
}
?>
