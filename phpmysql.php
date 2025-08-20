<?php
// Datos de conexión
$host = "localhost";       // o 127.0.0.1
$usuario = "root";         // tu usuario de MySQL
$contrasena = "alumno";          // tu contraseña (vacía por defecto en localhost)

// Crear conexión
$conexion = new mysqli($host, $usuario, $contrasena);

// Verificar conexión
if ($conexion->connect_error) {
    die("❌ Error de conexión: " . $conexion->connect_error);
}

echo "✅ Conexión exitosa a la base de datos '$base_de_datos'";

// Cerrar conexión
$conexion->close();
?>