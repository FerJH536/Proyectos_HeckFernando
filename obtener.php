<?php
header("Content-Type: application/json");
require "ConnectDB.php";

$sql = "SELECT * FROM lista_productos";
$result = $conn->query($sql);

$productos = [];

/*while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
}*/

while ($fila = $result->fetch_assoc()) {
    $productos[] = [
        "IdProducto" => $fila["IdProducto"],
        "nombre_producto" => $fila["nombre_producto"],
        "categoria" => $fila["categoria"],
        "precio" => floatval($fila["precio"]),
        "stock" => intval($fila["stock"])
    ];
}

echo json_encode($productos, JSON_UNESCAPED_UNICODE | JSON_NUMERIC_CHECK);
$conn->close();
?>