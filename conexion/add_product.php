<?php
// Conexión a la base de datos
include('conexion.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Variables del formulario
    $nombre = $_POST['nombre'];
    $categoria_id = $_POST['categoria_id'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $stock = $_POST['stock'];
    
    // Capturar la ruta de la imagen
    $imagen = $_POST['imagen'];  // Recibimos la ruta de la imagen desde el formulario
    
    // Inserción de producto en la base de datos
    $sql = "INSERT INTO productos (nombre, categoria_id, imagen, precio, descripcion, stock) 
            VALUES ('$nombre', '$categoria_id', '$imagen', '$precio', '$descripcion', '$stock')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Nuevo producto agregado correctamente";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>