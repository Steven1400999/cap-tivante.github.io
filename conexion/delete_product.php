<?php
header('Content-Type: application/json');
include 'conexion.php'; // Incluye la conexión a la base de datos

// Verifica si la solicitud es un POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtiene el ID del producto a eliminar
    $id = $_POST['id'];

    // Query para eliminar el producto
    $query = "DELETE FROM productos WHERE id=$id";

    if ($conn->query($query) === TRUE) {
        echo json_encode(['message' => 'Producto eliminado correctamente.']);
    } else {
        echo json_encode(['message' => 'Error al eliminar el producto: ' . $conn->error]);
    }
}
?>
