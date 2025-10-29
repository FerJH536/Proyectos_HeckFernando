<?php
require "ConnectDB.php";

$data = json_decode(file_get_contents("php://input"), true);

$id = $data["IdProducto"];
$nombre = $data["nombre_producto"];
$categoria = $data["categoria"];
$precio = $data["precio"];
$stock = $data["stock"];

$sql = "UPDATE lista_productos 
        SET nombre_producto=?, categoria=?, precio=?, stock=? 
        WHERE IdProducto=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdii", $nombre, $categoria, $precio, $stock, $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Producto actualizado"]);
} else {
    echo json_encode(["success" => false, "message" => "Error al actualizar"]);
}

$stmt->close();
$conn->close();
?>
