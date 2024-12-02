<?php
include 'conexion.php'; // Conexión a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $stock = $_POST['stock'];

    // Consulta SQL para actualizar el producto
    $sql = "UPDATE productos SET nombre='$nombre', precio='$precio', descripcion='$descripcion', stock='$stock' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Producto actualizado correctamente";
    } else {
        echo "Error al actualizar el producto: " . $conn->error;
    }

    $conn->close();
}
?>
