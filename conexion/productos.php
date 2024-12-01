<?php
include('conexion.php');

// Obtener los productos desde la base de datos
$sql = "SELECT p.id, p.nombre, p.precio, p.imagen, p.descripcion, c.nombre AS categoria
        FROM productos p
        INNER JOIN categorias c ON p.categoria_id = c.id";
$result = $conn->query($sql);

$productos = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = $row;
    }
}

// Convertir el array de productos a JSON y enviarlo como respuesta
echo json_encode($productos);

$conn->close();
?>
