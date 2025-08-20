<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="estiloarray.css">
    <meta charset="UTF-8">
    <title>Reporte de Estudiantes</title>
</head>
<body>

<?php
require_once 'funciones.php';
require_once 'datos.php';

// Calcular promedios y encontrar al estudiante con mejor promedio
$mejorPromedio = 0;
$estudianteMejorPromedio = null;

foreach ($estudiantes as &$estudiante) {
    $estudiante['promedio'] = calcularPromedio($estudiante['notas']);
    if ($estudiante['promedio'] > $mejorPromedio) {
        $mejorPromedio = $estudiante['promedio'];
        $estudianteMejorPromedio = $estudiante;
    }
}
unset($estudiante);

require 'formato.php';
?>

</body>
</html>