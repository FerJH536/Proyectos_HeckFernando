<?php
function calcularPromedio($notas) {
    if (empty($notas)) {
        return 0;
    }
    return array_sum($notas) / count($notas);
}
?>