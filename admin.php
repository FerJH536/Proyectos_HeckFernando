<?php
require 'ConnectDB.php';

$accion = $_GET['accion'] ?? '';

?>
<html>
<head>
    <link rel="stylesheet" href="estiloDB.css">
</head>
<body>
<h1>Panel de Administración</h1>

<div class="nav">
    <form method="get">
        <input type="hidden" name="accion" value="agregarAlumno">
        <button>Agregar Alumno</button>
    </form>
    <form method="get">
        <input type="hidden" name="accion" value="modificarAlumno">
        <button>Modificar Alumno</button>
    </form>
    <form method="get">
        <input type="hidden" name="accion" value="eliminarAlumno">
        <button>Eliminar Alumno</button>
    </form>
    <form method="get">
        <input type="hidden" name="accion" value="agregarMateria">
        <button>Agregar Materia</button>
    </form>
    <form method="get">
        <input type="hidden" name="accion" value="agregarNota">
        <button>Agregar Nota</button>
    </form>
</div>

<?php

$sqlCarreras = "SELECT IDCarrera, Carrera FROM Carreras";
$carreras = $pdo->query($sqlCarreras)->fetchAll();

$sqlAlumnos = "SELECT IDAlumno, Alumno FROM Estudiantes";
$alumnos = $pdo->query($sqlAlumnos)->fetchAll();

$sqlMaterias = "SELECT IDMateria, Materia FROM Materias";
$materias = $pdo->query($sqlMaterias)->fetchAll();

switch ($accion) {
    case 'agregarAlumno':
        ?>
        <h2>Nuevo Alumno</h2>
        <form method="post" action="procesar.php">
            <input type="hidden" name="tipo" value="alumno">
            <label>Nombre: <input type="text" name="nombre" required></label><br>
    
        <label>Carrera: 
            <select name="idcarrera" required>
                <?php foreach ($carreras as $c): ?>
                    <option value="<?= $c['IDCarrera'] ?>">
                        <?= htmlspecialchars($c['Carrera']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label><br>
            <button type="submit">Guardar</button>
        </form>
        <?php
        break;

    case 'modificarAlumno':
        ?>
        <h2>Modificar Alumno</h2>
        <form method="post" action="procesar.php">
            <input type="hidden" name="tipo" value="modificarAlumno">

            <label>Seleccionar Alumno:
                <select name="idalumno" required>
                    <?php foreach ($alumnos as $a): ?>
                        <option value="<?= $a['IDAlumno'] ?>">
                            <?= htmlspecialchars($a['Alumno']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label><br>

            <label>Nuevo Nombre: <input type="text" name="nombre" required></label><br>

            <label>Carrera:
                <select name="idcarrera" required>
                    <?php foreach ($carreras as $c): ?>
                        <option value="<?= $c['IDCarrera'] ?>">
                            <?= htmlspecialchars($c['Carrera']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label><br>

            <button type="submit">Guardar Cambios</button>
        </form>
        <?php
        break;

    case 'eliminarAlumno':
        ?>
        <h2>Eliminar Alumno</h2>
        <form method="post" action="procesar.php">
            <input type="hidden" name="tipo" value="eliminarAlumno">
            
            <label>Seleccionar Alumno:
                <select name="idalumno" required>
                    <?php foreach ($alumnos as $a): ?>
                        <option value="<?= $a['IDAlumno'] ?>">
                            <?= htmlspecialchars($a['Alumno']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label><br>

            <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar este alumno?');">
                Eliminar
            </button>
        </form>
        <?php
        break;

    case 'agregarMateria':
        ?>
        <h2>Nueva Materia</h2>
        <form method="post" action="procesar.php">
            <input type="hidden" name="tipo" value="materia">
            <label>Materia: <input type="text" name="materia" required></label><br>
    
            <label>Carrera: 
                <select name="idcarrera" required>
                    <?php foreach ($carreras as $c): ?>
                        <option value="<?= $c['IDCarrera'] ?>">
                            <?= htmlspecialchars($c['Carrera']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label><br>
            <button type="submit">Guardar</button>
        </form>
        <?php
        break;

    case 'agregarNota':
        ?>
        <h2>Nueva Nota</h2>
        <form method="post" action="procesar.php">
            <input type="hidden" name="tipo" value="nota">
    
            <label>Alumno:
                <select name="idalumno" required>
                    <?php foreach ($alumnos as $a): ?>
                        <option value="<?= $a['IDAlumno'] ?>">
                            <?= htmlspecialchars($a['Alumno']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label><br>
    
            <label>Materia:
                <select name="idmateria" required>
                    <?php foreach ($materias as $m): ?>
                        <option value="<?= $m['IDMateria'] ?>">
                            <?= htmlspecialchars($m['Materia']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label><br>
    
            <label>1º Parcial: <input type="number" name="p1" step="0.01" required></label><br>
            <label>2º Parcial: <input type="number" name="p2" step="0.01" required></label><br>
            <label>3º Parcial: <input type="number" name="p3" step="0.01" required></label><br>
    
            <button type="submit">Guardar</button>
        </form>
        <?php
        break;

    default:
        echo "<p>Selecciona una acción para administrar los datos.</p>";
}
?>
</body>

<div style="text-align: left; margin-top: 30px;">
    <form action="PagPrincipal.php" method="get">
        <button type="submit">Pagina Principal</button>
    </form>
</div>
</html>