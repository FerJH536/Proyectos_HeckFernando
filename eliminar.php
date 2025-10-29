<?php
require "ConnectDB.php";

$data = json_decode(file_get_contents("php://input"), true);
$id = $data["IdProducto"];

$sql = "DELETE FROM lista_productos WHERE IdProducto=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Producto eliminado"]);
} else {
    echo json_encode(["success" => false, "message" => "Error al eliminar"]);
}

$stmt->close();
$conn->close();
?>
