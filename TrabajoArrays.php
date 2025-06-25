<?php

$lista_compras= ["pan","leche","huevos","arroz"];
echo "<h3>Lista de Compras: $lista_compras</h3";
$codigo=0;

foreach ($lista_compras as $codigo => $producto){
    $codigo=$codigo+1;
    echo $codigo.":" .$producto;
}
$lista_compras[]="Queso";
$lista_compras[]="Tomate";

$cantidad=count($lista_compras);
echo"Hay $cantidad Productos en la Lista";

?>