<?php

$lista_compras = ["pan", "leche", "huevos", "arroz"];

echo "<h3>Lista de Compras:</h3>";
echo "<ul>";
foreach ($lista_compras as $producto) {
    echo "<li>$producto</li>";
}
echo "</ul>";

$lista_compras[] = "Queso";
$lista_compras[] = "Tomate";

echo "<h4>Lista numerada:</h4>";
echo "<ol>";
foreach ($lista_compras as $codigo => $producto) {
    echo "<li>$producto</li>";
}
echo "</ol>";

$cantidad = count($lista_compras);
echo "<p><strong>Hay $cantidad productos en la lista.</strong></p>";

if (in_array("leche", $lista_compras)) {
    echo "<p>✔ El producto <strong>leche</strong> está en la lista de compras.</p>";
} else {
    echo "<p>✘ El producto <strong>leche</strong> no está en la lista.</p>";
}

?>