<?php
// Incluir el archivo de conexión
include '../Controllers/Conexion.php';

// Consulta para obtener los datos de la tabla "pendientes" ordenados por prioridad
$sql = "SELECT id, numero, prioridad, fecha_creacion FROM pendientes ORDER BY prioridad ASC";
$result = $conexion->query($sql);

// Iniciar la salida HTML
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../logo titulo.png" type="image/png">
    <title>Lista de Pendientes</title>
    <link rel="stylesheet" href="esti.css"> <!-- Archivo CSS externo -->
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
                        <li><a href="/A.C-Asset-Control-/Pagina%20AC/pendientes/formulario.html">Pendientes</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="container mt-4">
        <h2 class="text-center">Lista de Pendientes</h2>
        <input type="text" id="searchInput" placeholder="Buscar en la tabla...">

        <table class="table">
            <thead>
                <tr>
                    <th>Número</th>
                    <th>Prioridad</th>
                    <th>Fecha de Creación</th>
                    <th>Acciones</th> <!-- Columna de acciones -->
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

                        // Corregir la correspondencia de las prioridades
                        switch ($row['prioridad']) {
                            case 1:
                                $prioridad_texto = 'Extrema Prioridad (1 día)';
                                break;
                            case 3:
                                $prioridad_texto = 'Mucha Prioridad (3 días)';
                                break;
                            case 5:
                                $prioridad_texto = 'Prioridad Intermedia (5 días)';
                                break;
                            case 7:
                                $prioridad_texto = 'Poca Prioridad (7 días)';
                                break;
                            case 10:
                                $prioridad_texto = 'Nada de Prioridad (10 días)';
                                break;
                            default:
                                $prioridad_texto = 'Desconocida';
                                break;
                        }
                        echo '<td>' . htmlspecialchars($prioridad_texto) . '</td>';
                        echo '<td>' . htmlspecialchars($row['fecha_creacion']) . '</td>';

                        // Botón de eliminar
                        echo "<td>
                                <form action='delete_document.php' method='POST' onsubmit='return confirm(\"¿Estás seguro de que deseas eliminar este pendiente?\");'>
                                    <input type='hidden' name='id' value='" . $row['id'] . "'>
                                    <button type='submit' class='btn btn-danger custom-btn'>Eliminar</button>
                                </form>
                              </td>";

                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4" class="text-center">No hay registros disponibles.</td></tr>';
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
