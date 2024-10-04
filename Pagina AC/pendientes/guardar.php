<?php
// Incluir la conexión a la base de datos
require_once '../Controllers/Conexion.php';

// Comprobar si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $numero = isset($_POST['numero']) ? trim($_POST['numero']) : '';
    $prioridad = isset($_POST['prioridad']) ? (int)$_POST['prioridad'] : 0; // Convertir prioridad a entero

    // Validar los datos
    if (!empty($numero) && $prioridad > 0) {
        // Preparar la consulta
        $stmt = $conexion->prepare("INSERT INTO pendientes (numero, prioridad) VALUES (?, ?)");
        $stmt->bind_param("si", $numero, $prioridad); // 'si' indica que es un string y un entero

        // Ejecutar la consulta
        if ($stmt->execute()) {
            echo "Documento guardado exitosamente.";
        } else {
            echo "Error al guardar el documento: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Por favor, completa todos los campos correctamente.";
    }
}

// Cerrar la conexión
$conexion->close();
?>
