<!-- tabla_costes.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tabla de Costes</title>
    <link rel="stylesheet" href="../styles/global.css" />
    <link rel="stylesheet" href="../styles/form_folleto.css" />
</head>
<body>
    <main>
        <h2>Tabla de Costes Generada con PHP</h2>
        <table>
            <thead>
                <tr>
                    <th rowspan="2">Número de páginas</th>
                    <th rowspan="2">Número de fotos</th>
                    <th colspan="2">Blanco y negro</th>
                    <th colspan="2">Color</th>
                </tr>
                <tr>
                    <th>150-300 dpi</th>
                    <th>450-900 dpi</th>
                    <th>150-300 dpi</th>
                    <th>450-900 dpi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Variables base
                $base = 10;
                $costePagina = 0;
                
                // Generar las filas de la tabla
                for ($i = 1, $j = 3; $i <= 15; $i++, $j += 3) {
                    $baseTotal = $base;
                    
                    // Calcular el coste por página
                    for ($k = 1; $k <= $i; $k++) {
                        if ($k < 5) {
                            $costePagina = 2;
                        } elseif ($k > 10) {
                            $costePagina = 1.6;
                        } else {
                            $costePagina = 1.8;
                        }
                        $baseTotal += $costePagina;
                    }

                    // Redondear el resultado a 2 decimales
                    $baseTotal = number_format($baseTotal, 2);
                    $baseCalidad = number_format($baseTotal + $j * 0.2, 2);
                    $baseColor = number_format($baseTotal + $j * 0.5, 2);
                    $baseColorCalidad = number_format($baseCalidad + $j * 0.5, 2);

                    // Imprimir la fila de la tabla
                    echo "<tr>
                            <td>{$i} Páginas</td>
                            <td>{$j} fotos</td>
                            <td>{$baseTotal} €</td>
                            <td>{$baseCalidad} €</td>
                            <td>{$baseColor} €</td>
                            <td>{$baseColorCalidad} €</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </main>
</body>
</html>
