<?php
header('Content-Type: application/json');
include 'conexion.php'; // Incluye el archivo de conexión a la base de datos

$query = "
    SELECT productos.id, productos.nombre, productos.imagen, productos.precio, productos.descripcion, 
           categorias.nombre AS categoria_nombre, productos.stock
    FROM productos
    INNER JOIN categorias ON productos.categoria_id = categorias.id
"; // Query modificada para obtener el nombre de la categoría
$result = $conn->query($query);

$productos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $productos[] = [
            'id' => $row['id'],
            'nombre' => $row['nombre'],
            'imagen' => $row['imagen'],
            'precio' => $row['precio'],
            'descripcion' => $row['descripcion'],
            'categoria' => $row['categoria_nombre'], // Aquí se obtiene el nombre de la categoría
            'stock' => $row['stock']
        ];
    }
}
echo json_encode($productos); // Devuelve los productos como JSON
?>
