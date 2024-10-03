<?php
// Incluir el archivo de conexión
include '../Controllers/Conexion.php'; // Asegúrate de que la ruta sea correcta

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

// Preparar y vincular
$stmt = $conexion->prepare("INSERT INTO  emitidos (oficina, firma, asunto, adjunto, fecha, numero) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $oficina, $firma, $adjunto,  $asunto, $fecha, $numero);

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