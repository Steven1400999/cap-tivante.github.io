<?php
include 'conexion.php'; // Conexión a la base de datos

header("Content-Type: application/json");  // Establece la respuesta como JSON

// Lee los datos JSON del cuerpo de la solicitud
$input = json_decode(file_get_contents('php://input'), true);

// Verifica si los datos son válidos
if (!$input) {
    echo json_encode(["success" => false, "message" => "Datos no válidos recibidos"]);
    exit();
}

// Recupera los valores del cuerpo JSON
$nombre = $conn->real_escape_string($input['nombre']);
$apellidos = $conn->real_escape_string($input['apellidos']);
$correo = $conn->real_escape_string($input['correo']);
$contraseña = password_hash($input['contraseña'], PASSWORD_DEFAULT);
$usuario = $conn->real_escape_string($input['usuario']);
$direccion = $conn->real_escape_string($input['direccion']);
$ciudad = $conn->real_escape_string($input['ciudad']);
$rol = 0;

// Verifica si el correo ya está registrado
$correo_check = $conn->query("SELECT id FROM usuarios WHERE correo = '$correo'");
if ($correo_check->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "El correo electrónico ya está registrado."]);
    exit();
}

// Verifica si el nombre de usuario ya está registrado
$usuario_check = $conn->query("SELECT id FROM usuarios WHERE usuario = '$usuario'");
if ($usuario_check->num_rows > 0) {
    echo json_encode(["success" => false, "message" => "El nombre de usuario ya está registrado."]);
    exit();
}

// Valida que no haya campos vacíos
if (empty($nombre) || empty($apellidos) || empty($correo) || empty($contraseña) || empty($usuario) || empty($direccion) || empty($ciudad)) {
    echo json_encode(["success" => false, "message" => "Todos los campos son obligatorios."]);
    exit();
}

// Inserta los datos en la base de datos
$sql = "INSERT INTO usuarios (nombre, apellidos, correo, contraseña, usuario, direccion, ciudad, rol)
        VALUES ('$nombre', '$apellidos', '$correo', '$contraseña', '$usuario', '$direccion', '$ciudad', '$rol')";

// Ejecuta la consulta y verifica si se insertaron correctamente
if ($conn->query($sql) === TRUE) {
    echo json_encode(["success" => true, "message" => "Registro exitoso."]);
} else {
    // En caso de error, loguear el error y devolver un mensaje genérico
    error_log("Error en la inserción de usuario: " . $conn->error);
    echo json_encode(["success" => false, "message" => "Hubo un problema al registrar el usuario."]);
}

$conn->close();  // Cierra la conexión a la base de datos
?>
