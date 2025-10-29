<?php
require "ConnectDB.php";

$data = json_decode(file_get_contents("php://input"), true);

$nombre = $data["nombre_producto"];
$categoria = $data["categoria"];
$precio = $data["precio"];
$stock = $data["stock"];

$sql = "INSERT INTO lista_productos (nombre_producto, categoria, precio, stock)
        VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdi", $nombre, $categoria, $precio, $stock);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Producto agregado"]);
} else {
    echo json_encode(["success" => false, "message" => "Error al agregar"]);
}

$stmt->close();
$conn->close();
?>
