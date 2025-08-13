<!DOCTYPE html>
<body>
    <link rel="stylesheet" href="estiloarray.css">
</body>

<?php

// Función para calcular el promedio de un estudiante
function calcularPromedio($notas) {
    if (empty($notas)) {
        return 0;
    }
    return array_sum($notas) / count($notas);
}

// Datos de estudiantes
$estudiantes = [
    [
        'nombre' => 'Juan',
        'edad' => 20,
        'carrera' => 'Ingeniería',
        'notas' => [8, 7, 9, 6],
    ],
    [
        'nombre' => 'María',
        'edad' => 22,
        'carrera' => 'Medicina',
        'notas' => [10, 9, 8, 9],
    ],
    [
        'nombre' => 'Pedro',
        'edad' => 21,
        'carrera' => 'Derecho',
        'notas' => [7, 6, 7, 8],
    ],
];

// Calcular promedios y encontrar al estudiante con mejor promedio
$mejorPromedio = 0;
$estudianteMejorPromedio = null;
foreach ($estudiantes as &$estudiante) { // Added & to modify the original array
    $estudiante['promedio'] = calcularPromedio($estudiante['notas']);
    if ($estudiante['promedio'] > $mejorPromedio) {
        $mejorPromedio = $estudiante['promedio'];
        $estudianteMejorPromedio = $estudiante;
    }
}

// Mostrar reporte completo
echo "<h1>Reporte de Estudiantes</h1>";
echo "<table border='1'>";
echo "<thead><tr><th>Nombre</th><th>Edad</th><th>Carrera</th><th>Notas</th><th>Promedio</th></tr></thead>";
echo "<tbody>";
foreach ($estudiantes as $estudiante) {
    echo "<tr>";
    echo "<td>" . $estudiante['nombre'] . "</td>";
    echo "<td>" . $estudiante['edad'] . "</td>";
    echo "<td>" . $estudiante['carrera'] . "</td>";
    echo "<td>" . implode(', ', $estudiante['notas']) . "</td>";
    echo "<td>" . number_format($estudiante['promedio'], 2) . "</td>";
    echo "</tr>";
}
echo "</tbody></table>";

if ($estudianteMejorPromedio) {
    echo "<p>El estudiante con mejor promedio es: " . $estudianteMejorPromedio['nombre'] . " con un promedio de " . number_format($mejorPromedio, 2) . "</p>";
} else {
    echo "<p>No hay estudiantes para mostrar.</p>";
}

?>