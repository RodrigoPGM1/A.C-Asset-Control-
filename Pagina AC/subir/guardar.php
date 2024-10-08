<?php
// Incluir el archivo de conexión
include '../Controllers/Conexion.php'; // Asegúrate de que la ruta sea correcta

// Verifica que la conexión fue exitosa
if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}

// Recibir los datos del formulario
$oficina = $_POST['oficina'];
$documento = $_POST['documento'];
$expediente = $_POST['expediente'];
$firma = $_POST['firma'];
$cargo = $_POST['cargo'];
$oficio = $_POST['oficio'];
$asunto = $_POST['asunto'];
$fecha = $_POST['fecha'];
$numero = $_POST['numero'];
$observacion = $_POST['observacion']; // Agrega esta línea

// Guardar los documentos en la base de datos
$stmt = $conexion->prepare("INSERT INTO recibidos (oficina, documento, expediente, firma, cargo, oficio, asunto, fecha, numero, observacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssssss", $oficina, $documento, $expediente, $firma, $cargo, $oficio, $asunto, $fecha, $numero, $observacion); // Agrega $observacion aquí

if ($stmt->execute()) {
    echo "Los datos se han guardado correctamente.";
} else {
    echo "Error al guardar los datos: " . $stmt->error;
}

// Procesar la subida de archivos
$carpetaDestino = "C:\\xampp\\htdocs\\A.C-Asset-Control-\\Recibidos\\"; // Ruta de destino
foreach ($_FILES['archivos']['tmp_name'] as $index => $tmpName) {
    $nombreArchivo = $_FILES['archivos']['name'][$index];
    $rutaCompleta = $carpetaDestino . basename($nombreArchivo);

    // Mover el archivo subido a la carpeta de destino
    if (move_uploaded_file($tmpName, $rutaCompleta)) {
        echo "Archivo " . $nombreArchivo . " subido correctamente.<br>";
    } else {
        echo "Error al subir el archivo " . $nombreArchivo . ".<br>";
    }
}

// Cerrar la conexión
$stmt->close();
$conexion->close();
?>
