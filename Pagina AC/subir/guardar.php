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

// Preparar y vincular
$stmt = $conexion->prepare("INSERT INTO recibidos (oficina, documento, expediente, firma, cargo, oficio, asunto, fecha, numero) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssssss", $oficina, $documento, $expediente, $firma, $cargo, $oficio, $asunto, $fecha, $numero);

// Ejecutar la consulta
if ($stmt->execute()) {
    echo "Los datos se han guardado correctamente.";
} else {
    echo "Error al guardar los datos: " . $stmt->error;
}

// Cerrar la conexión
$stmt->close();
$conexion->close();
?>
