<?php
$servername = "localhost";
$username = "root";
$password = "";    
$dbname = "cap-tivanteDB";

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
