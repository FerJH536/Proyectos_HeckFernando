<?php
session_start();
require 'ConnectDB.php';

$alumno = $_POST['alumno'] ?? '';
$password = $_POST['password'] ?? '';

// consulta preparada para evitar inyección SQL
$sql = "SELECT Alumno, Password FROM Usuarios WHERE Alumno = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$alumno]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {
    // usar hash_equals para comparación más segura frente a timing attacks
    if (is_string($user['Password']) && hash_equals((string)$user['Password'], (string)$password)) {
        // login correcto
        $_SESSION['alumno'] = $user['Alumno'];
        header("Location: PagPrincipal.php");
        exit;
    }
}

// si llegamos acá, login fallido
header("Location: login.php?error=1");
exit;