<?php
require 'ConnectDB.php';

$titulo = "Gestión de Alumnos";
$accion = $_GET['accion'] ?? 'insertar';

// Si se va a modificar, cargamos los datos del alumno
$alumnoEdit = null;
if ($accion === 'modificar' && isset($_GET['id'])) {
    $stmt = $pdo->prepare("SELECT * FROM Estudiantes WHERE IDAlumno = ?");
    $stmt->execute([$_GET['id']]);
    $alumnoEdit = $stmt->fetch();
}
?>

<html>
<head>
    <link rel="stylesheet" href="estiloDB.css">
</head>
<body>

<h1><?= htmlspecialchars($titulo) ?></h1>

<!-- Menú de acciones -->
<div class="nav">
    <form method="get" action="">
        <input type="hidden" name="accion" value="insertar">
        <button type="submit">Insertar Alumno</button>
    </form>
    <form method="get" action="">
        <input type="hidden" name="accion" value="modificar">
        <button type="submit">Modificar Alumno</button>
    </form>
    <form method="get" action="">
        <input type="hidden" name="accion" value="eliminar">
        <button type="submit">Eliminar Alumno</button>
    </form>
</div>

<hr>

<?php
switch ($accion) {
    case 'insertar':
        echo "<h2>Insertar Nuevo Alumno</h2>";
        ?>
        <form method="post" action="procesar_alumno.php?accion=insertar">
            <label>Nombre del Alumno: <input type="text" name="alumno" required></label><br>
            <label>Edad del Alumno: <input type="number" name="edad" required></label><br>
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
            <button type="submit">Guardar Alumno</button>
        </form>
        <?php
        break;

    case 'modificar':
        echo "<h2>Modificar Alumno</h2>";

        // Mostrar lista de alumnos para elegir cuál editar
        $alumnos = $pdo->query("SELECT * FROM Estudiantes")->fetchAll();
        foreach ($alumnos as $a) {
            echo "<div><a href='admin_alumnos.php?accion=modificar&id={$a['IDAlumno']}'>{$a['Alumno']}</a></div>";
        }

        // Si se seleccionó un alumno, mostrar formulario de edición
        if ($alumnoEdit): ?>
            <form method="post" action="procesar_alumno.php?accion=modificar">
                <input type="hidden" name="id" value="<?= $alumnoEdit['IDAlumno'] ?>">
                <label>Nombre del Alumno: <input type="text" name="alumno" value="<?= htmlspecialchars($alumnoEdit['Alumno']) ?>" required></label><br>
                <label>Edad del Alumno: <input type="number" name="edad" value="<?= htmlspecialchars($alumnoEdit['Edad']) ?>" required></label><br>
                <label>Carrera:
                    <select name="idCarrera">
                        <?php
                        foreach ($carreras as $carrera) {
                            $selected = ($carrera['IDCarrera'] == $alumnoEdit['IDCarrera']) ? 'selected' : '';
                            echo "<option value='{$carrera['IDCarrera']}' $selected>{$carrera['Carrera']}</option>";
                        }
                        ?>
                    </select>
                </label><br>
                <button type="submit">Actualizar Alumno</button>
            </form>
        <?php endif;
        break;

    case 'eliminar':
        echo "<h2>Eliminar Alumno</h2>";
        $alumnos = $pdo->query("SELECT * FROM Estudiantes")->fetchAll();
        foreach ($alumnos as $a) {
            echo "<form method='post' action='procesar_alumno.php?accion=eliminar' onsubmit=\"return confirm('¿Seguro que quieres eliminar a {$a['Alumno']}?');\">
                    <input type='hidden' name='id' value='{$a['IDAlumno']}'>
                    <span>{$a['Alumno']} (Edad: {$a['Edad']})</span>
                    <button type='submit'>Eliminar</button>
                </form>";
        }
        break;

    default:
        echo "<p>Acción no válida.</p>";
        break;
}
?>

<hr>
<form action="admin.php" method="get"><button type="submit">← Volver al panel de administración</button></form>

</body>
</html>