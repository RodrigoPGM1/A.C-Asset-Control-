<?php
// Manejo de la subida de archivos
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $target_dir = "C:\\Users\\CPE_MPAR_APOYO2\\Desktop\\documentos_subidos\\"; // Ruta de la carpeta donde se guardarán los archivos
    $tableHtml = ''; // Variable para almacenar el HTML de la tabla
    $successMessage = ''; // Variable para el mensaje de éxito
    $uploadSuccess = false; // Variable para controlar el estado de la carga

    // Verificar si la carpeta de destino existe
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0777, true); // Crear la carpeta si no existe
    }

    // Obtener los archivos subidos
    foreach ($_FILES['fileToUpload']['name'] as $key => $name) {
        $target_file = $target_dir . basename($name);
        $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt', 'ppt', 'pptx']; // Tipos de archivos permitidos

        // Verificar si el archivo está en el formato permitido
        if (in_array($fileType, $allowed_types)) {
            // Intentar mover el archivo subido a la carpeta especificada
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$key], $target_file)) {
                // Generar el HTML para la tabla
                $tableHtml .= "<tr><td>" . htmlspecialchars(basename($name)) . "</td>";
                $tableHtml .= "<td><button onclick='previewFile(\"file:///C:/Users/CPE_MPAR_APOYO2/Desktop/documentos_subidos/" . htmlspecialchars(basename($name)) . "\")'>Previsualizar</button></td></tr>";
                $uploadSuccess = true; // Al menos un archivo se subió exitosamente
            } else {
                // Mensaje de error si no se puede mover el archivo
                $successMessage .= "<div class='message'>Lo sentimos, hubo un error al subir el archivo " . htmlspecialchars(basename($name)) . ".</div>";
            }
        } else {
            // Mensaje si el tipo de archivo no es permitido
            $successMessage .= "<div class='message'>Lo sentimos, solo se permiten archivos de tipo: " . implode(', ', $allowed_types) . ".</div>";
        }
    }

    // Si se subieron archivos exitosamente, preparar el mensaje
    if ($uploadSuccess) {
        $successMessage = "<div class='message'>Archivos subidos exitosamente.</div>";
    }

    // Devolver la respuesta en formato JSON
    echo json_encode([
        'message' => $successMessage,
        'table' => $tableHtml
    ]);
    exit; // Finalizar la ejecución del script
}
?>
