<?php
// Incluir el archivo de conexión
include '../Controllers/Conexion.php';

// Verifica si se ha enviado el id
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Consulta para eliminar el documento de la tabla pendientes
    $sql = "DELETE FROM pendientes WHERE id = ?";

    // Preparar la consulta
    $stmt = $conexion->prepare($sql);

    // Enlazar el parámetro
    $stmt->bind_param("i", $id); // "i" indica que el parámetro es un entero

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Recargar la misma página después de la eliminación
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        // Si hay un error al eliminar
        echo "Error al eliminar el pendiente.";
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    // Si no se ha enviado el id
    echo "ID no válido.";
}

// Cerrar la conexión
$conexion->close();
?>
