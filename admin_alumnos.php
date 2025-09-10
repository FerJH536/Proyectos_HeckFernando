<?php
require 'ConnectDB.php';
$titulo = "Gestión de Alumnos";
// Aquí iría el código para insertar, modificar o eliminar alumnos
?>

<html>
<head>
    <link rel="stylesheet" href="estiloDB.css">
</head>
<body>

<h1><?= htmlspecialchars($titulo) ?></h1>

<p>Aquí puedes dar de alta, modificar o eliminar alumnos.</p>

<!-- Formulario de ejemplo para alta de alumno -->
<form method="post" action="">
    <label>Nombre del Alumno: <input type="text" name="alumno"></label><br>
    <label>Carrera:
        <select name="idCarrera">
            <?php
            $carreras = $pdo->query("SELECT IDCarrera, Carrera FROM Carreras")->fetchAll();
            foreach ($carreras as $carrera) {
                echo "<option value='{$carrera['IDCarrera']}'>{$carrera['Carrera']}</option>";
            }
            ?>
        </select>
    </label><br>
    <button type="submit" name="guardar">Guardar Alumno</button>
</form>

<form action="admin.php" method="get"><button type="submit">Panel Administracion</button></form>

</body>
</html>