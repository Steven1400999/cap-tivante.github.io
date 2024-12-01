<?php
$servername = "localhost";
$username = "root"; // Por defecto en XAMPP
$password = "";     // Contraseña vacía por defecto
$dbname = "cap-tivanteDB"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
// else {
   // echo "Conexión exitosa a la base de datos '$dbname'."; // Mensaje de éxito
//}
?>
