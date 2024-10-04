<?php
// Incluir el archivo de conexión
include '../Controllers/Conexion.php';

// Verifica si se ha enviado el id
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Consulta para eliminar el documento
    $sql = "DELETE FROM emitidos WHERE id = ?";
    
    // Preparar la consulta
    $stmt = $conexion->prepare($sql);
    
    // Enlazar el parámetro
    $stmt->bind_param("i", $id); // "i" indica que el parámetro es un entero

    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir de vuelta a la lista de documentos emitidos con un mensaje de éxito
        header("Location: miratusdocumentos.php?message=Documento eliminado con éxito.");
        exit();
    } else {
        // Redirigir de vuelta a la lista de documentos emitidos con un mensaje de error
        header("Location: miratusdocumentos.php?message=Error al eliminar el documento.");
        exit();
    }

    // Cerrar la declaración
    $stmt->close();
} else {
    // Si no se ha enviado el id, redirigir con un mensaje de error
    header("Location: miratusdocumentos.php?message=ID no válido.");
    exit();
}

// Cerrar la conexión
$conexion->close();
?>
