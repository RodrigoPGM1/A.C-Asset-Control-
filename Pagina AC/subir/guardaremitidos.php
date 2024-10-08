<?php
// Incluir el archivo de conexión
include '../Controllers/Conexion.php';

// Verifica que la conexión fue exitosa
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Recibir los datos del formulario
$firma = $_POST['firma'];
$adjunto = $_POST['adjunto'];
$oficina = $_POST['oficina'];
$asunto = $_POST['asunto'];
$fecha = $_POST['fecha'];
$numero = $_POST['numero'];
$observacion = $_POST['observacion'];  // Capturar el campo de observación

// Preparar y vincular
$stmt = $conexion->prepare("INSERT INTO emitidos (oficina, firma, asunto, adjunto, fecha, numero, observacion) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $oficina, $firma, $adjunto, $asunto, $fecha, $numero, $observacion);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Los datos se han guardado correctamente.";

    // Procesar archivos subidos
    $uploadDir = 'C:/xampp/htdocs/A.C-Asset-Control-/Emitidos/';
    
    foreach ($_FILES['files']['name'] as $index => $fileName) {
        $fileTmpName = $_FILES['files']['tmp_name'][$index];
        $fileDestination = $uploadDir . basename($fileName);

        // Mover el archivo a la carpeta destino
        if (move_uploaded_file($fileTmpName, $fileDestination)) {
            echo "El archivo $fileName se ha subido correctamente.<br>";
        } else {
            echo "Error al subir el archivo $fileName.<br>";
        }
    }

} else {
    echo "Error al guardar los datos: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conexion->close();
?>
