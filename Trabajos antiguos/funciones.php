<?php
function calcularPromedio($notas) {
    if (empty($notas)) {
        return 0;
    }
    return array_sum($notas) / count($notas);
}

function mejorPromedio ($estudiantes){
    $mejorPromedio = 0;
    $estudianteMejorPromedio = null;

    foreach ($estudiantes as &$estudiante){
        $estudiante['promedio'] = calcularPromedio($estudiante['notas']);
        if ($estudiante['promedio'] > $mejorPromedio) {
            $mejorPromedio = $estudiante['promedio'];
            $estudianteMejorPromedio = $estudiante;
        }
    }  
    unset($estudiante);
    return $estudianteMejorPromedio; $mejorPromedio;
}
?>