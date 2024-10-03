<?php
// Incluir el archivo de conexión
include '../Controllers/Conexion.php';

// Consulta para obtener los datos de la tabla "recibidos"
$sql = "SELECT numero, oficina, documento, expediente, firma, cargo, oficio, asunto, fecha FROM recibidos";
$result = $conexion->query($sql);

// Iniciar la salida HTML
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mira tus documentos</title>
    <!-- Enlace a Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa; /* Color de fondo para contraste */
        }
    </style>
</head>
<body>

    <header class="header">
        <div class="container">
            <div class="menu">
                <div class="logo">Control Patrimonial</div>
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="/A.C-Asset-Control-/Pagina%20AC/paginaweb/index.html#">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link" href="/A.C-Asset-Control-/Pagina%20AC/mirar/miratusdocumentos.php">Mira tus documentos</a></li>
                        <li class="nav-item"><a class="nav-link" href="/A.C-Asset-Control-/Pagina%20AC/subir/formulario.html">Sube tus documentos</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Pendientes</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">Emitidos</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>
    
    <div class="container mt-4">
        <h2 class="text-center">Lista de Documentos Recibidos</h2>
        <input type="text" id="searchInput" class="form-control mb-3" placeholder="Buscar en la tabla...">
        
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Número</th>
                    <th>Oficina</th>
                    <th>Documento</th>
                    <th>Expediente</th>
                    <th>Firma</th>
                    <th>Cargo</th>
                    <th>Oficio</th>
                    <th>Asunto</th>
                    <th>Fecha</th>
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
                        echo '<td>' . htmlspecialchars($row['documento']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['expediente']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['firma']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['cargo']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['oficio']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['asunto']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['fecha']) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="9" class="text-center">No hay registros disponibles.</td></tr>';
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

    <!-- Enlace a Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
