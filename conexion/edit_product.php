<?php
header('Content-Type: application/json');
include 'conexion.php'; // Incluye la conexión a la base de datos

// Verifica si la solicitud es un POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtiene los datos del formulario
    $id = $_POST['id']; // ID del producto a modificar
    $nombre = $_POST['nombre'];
    $imagen = $_POST['imagen']; // Imagen en formato base64
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $categoria_id = $_POST['categoria_id'];
    $stock = $_POST['stock'];

    // Query para actualizar el producto
    $query = "UPDATE productos SET nombre='$nombre', imagen='$imagen', precio='$precio', descripcion='$descripcion', categoria_id='$categoria_id', stock='$stock' WHERE id=$id";

    if ($conn->query($query) === TRUE) {
        echo json_encode(['message' => 'Producto actualizado correctamente.']);
    } else {
        echo json_encode(['message' => 'Error al actualizar el producto: ' . $conn->error]);
    }
}
?>
