<?php
require 'ConnectDB.php';

$tipo = $_POST['tipo'] ?? '';

switch ($tipo) {
    case 'alumno':
        $sql = "INSERT INTO Estudiantes (Alumno, IDCarrera) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST['nombre'], $_POST['idcarrera']]);
        break;

    case 'materia':
        $sql = "INSERT INTO Materias (Materia, IDCarrera) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST['materia'], $_POST['idcarrera']]);
        break;

    case 'nota':
        $sql = "INSERT INTO Notas (IDAlumno, IDMateria, PrimerParcial, SegundoParcial, TercerParcial) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST['idalumno'], $_POST['idmateria'], $_POST['p1'], $_POST['p2'], $_POST['p3']]);
        break;

    case 'modificarAlumno':
        $sql = "UPDATE Estudiantes SET Alumno = ?, IDCarrera = ? WHERE IDAlumno = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST['nombre'], $_POST['idcarrera'], $_POST['idalumno']]);
        break;
        
    case 'eliminarAlumno':
        $sql = "DELETE FROM Estudiantes WHERE IDAlumno = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$_POST['idalumno']]);
        break;
}

header("Location: admin.php");
exit;