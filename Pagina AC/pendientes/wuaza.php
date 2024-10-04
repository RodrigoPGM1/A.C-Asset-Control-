<?php
// Incluir el archivo de conexión
include '../Controllers/Conexion.php';

// Consulta para obtener los datos de la tabla "pendientes" ordenados por prioridad
$sql = "SELECT numero, prioridad, fecha_creacion FROM pendientes ORDER BY prioridad ASC";
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
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Estilo básico para la tabla */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 18px;
            text-align: left;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

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

    <div class="container mt-4">
        <h2 class="text-center">Lista de Pendientes</h2>
        <input type="text" id="searchInput" placeholder="Buscar en la tabla...">

        <table class="table">
            <thead>
                <tr>
                    <th>Número</th>
                    <th>Prioridad</th>
                    <th>Fecha de Creación</th>
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
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="3" class="text-center">No hay registros disponibles.</td></tr>';
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
