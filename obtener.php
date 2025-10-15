<?php
header("Content-Type: application/json");
require "ConnectDB.php";

$sql = "SELECT * FROM lista_productos";
$result = $conn->query($sql);

$productos = [];

while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
}

echo json_encode($productos, JSON_UNESCAPED_UNICODE);
$conn->close();
?>