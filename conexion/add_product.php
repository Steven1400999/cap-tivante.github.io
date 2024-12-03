<?php
include 'conexion.php'; 

// Verifica si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifica que los campos necesarios estén presentes
    if (isset($_POST['nombre'], $_POST['precio'], $_POST['descripcion'], $_POST['categoria_id'], $_POST['stock']) && isset($_FILES['imagen'])) {
        // Recoge los datos del formulario
        $nombre = $conn->real_escape_string($_POST['nombre']);
        $precio = $conn->real_escape_string($_POST['precio']);
        $descripcion = $conn->real_escape_string($_POST['descripcion']);
        $categoria_id = $conn->real_escape_string($_POST['categoria_id']);
        $stock = $conn->real_escape_string($_POST['stock']);

        // Verifica si el archivo de imagen se subió correctamente
        if ($_FILES['imagen']['error'] == 0) {
            // Define el directorio de destino para la imagen
            $target_dir = "../imagenes/";
            // Reemplaza los espacios con guiones bajos y asegura que el nombre del archivo sea seguro
            $target_file = $target_dir . basename(str_replace(" ", "_", $_FILES['imagen']['name']));

            // Verifica si la carpeta uploads existe, si no, crea la carpeta
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true); // Crea la carpeta si no existe
            }

            // Mueve el archivo subido al directorio
            if (move_uploaded_file($_FILES['imagen']['tmp_name'], $target_file)) {
                echo "El archivo " . basename($_FILES['imagen']['name']) . " se ha subido correctamente.";

                // Inserta la ruta de la imagen en la base de datos
                $imagen = 'imagenes/' . basename(str_replace(" ", "_", $_FILES['imagen']['name']));

                // Realiza la inserción en la base de datos
                $sql = "INSERT INTO productos (nombre, precio, descripcion, categoria_id, stock, imagen)
                        VALUES ('$nombre', '$precio', '$descripcion', '$categoria_id', '$stock', '$imagen')";

                // Ejecuta la consulta
                if ($conn->query($sql)) {
                    header("Location: ../crud.html");
                    exit();
                } else {
                    echo 'Error al agregar el producto: ' . $conn->error;
                }
            } else {
                echo "Hubo un error al subir el archivo.";
            }
        } else {
            echo "No se ha subido ningún archivo o hubo un error en la subida.";
        }
    } else {
        echo 'Por favor, completa todos los campos';
    }
}
?>
