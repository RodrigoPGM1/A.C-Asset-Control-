<?php
// Incluir el archivo de conexión
include '../Controllers/Conexion.php';

// Consulta para obtener los datos de la tabla "emitidos"
$sql = "SELECT id, numero, oficina, firma, asunto, adjunto, fecha FROM emitidos";
$result = $conexion->query($sql);

// Iniciar la salida HTML
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mira tus documentos emitidos</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Estilo para el botón de eliminar */
        .btn-eliminar {
            background-color: #ff0015; /* Color de fondo del botón */
            color: white; /* Color del texto */
            border: none; /* Sin borde */
            padding: 5px 10px; /* Relleno del botón */
            cursor: pointer; /* Cambiar el cursor al pasar sobre el botón */
            border-radius: 5px; /* Bordes redondeados */
        }

        .btn-eliminar:hover {
            background-color: #d60012; /* Color al pasar el mouse */
        }
    </style>
</head>
<body>

    <header class="header">
        <div class="container">
            <div class="menu">
                <div class="logo">Control Patrimonial</div>
                <nav class="navbar">
                    <ul>
                        <li><a href="/A.C-Asset-Control-/Pagina%20AC/paginaweb/index.html#">Inicio</a></li>
                        <li><a href="/A.C-Asset-Control-/Pagina%20AC/mirar/miratusdocumentos.php">Mira tus documentos</a></li>
                        <li><a href="/A.C-Asset-Control-/Pagina%20AC/subir/formulario.html">Sube tus documentos</a></li>
                        <li><a href="#">Pendientes</a></li>
                        <li><a href="#">Emitidos</a></li>
                        <li><a href="#">Drive</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    
    <div class="container mt-4">
        <h2 class="text-center">Lista de Documentos Emitidos</h2>
        <input type="text" id="searchInput" placeholder="Buscar en la tabla...">
        
        <table class="table">
            <thead>
                <tr>
                    <th>Número</th>
                    <th>Oficina</th>
                    <th>Firma</th>
                    <th>Asunto</th>
                    <th>Adjunto</th>
                    <th>Fecha</th>
                    <th>Acción</th> <!-- Nueva columna para el botón de eliminar -->
                </tr>
            </thead>
            <tbody id="documentTable">
                <?php
                // Verifica si hay resultados
                if ($result->num_rows > 0) {
                    // Mostrar datos de cada fila
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['numero']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['oficina']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['firma']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['asunto']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['adjunto']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['fecha']) . '</td>';
                        echo '<td><form action="delete_document.php" method="POST"><input type="hidden" name="id" value="' . htmlspecialchars($row['id']) . '"><button type="submit" class="btn-eliminar">Eliminar</button></form></td>'; // Botón para eliminar
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="7" class="text-center">No hay registros disponibles.</td></tr>';
                }

                // Cerrar la conexión
                $conexion->close();
                ?>
            </tbody>
        </table>
    </div>

    <script>
        // Función de búsqueda en la tabla
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#documentTable tr');

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });
    </script>

</body>
</html>
