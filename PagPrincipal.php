<?php

require 'ConnectDB.php';

$vista = $_GET['vista'] ?? 'inicio';
$datos = [];
$titulo = '';

switch ($vista) {
    case 'alumnos':
        $titulo = 'Alumnos';
        $sql = "SELECT IDAlumno, Alumno, Carrera From Estudiantes, Carreras Where Estudiantes.IDCarrera=Carreras.IDCarrera";
        $datos = $pdo->query($sql)->fetchAll();
        break;

    case 'materias':
        $titulo = 'Materias';
        $sql = "SELECT Materias.Materia, Carreras.Carrera From Materias, Carreras Where Materias.IDCarrera=Carreras.IDCarrera";
        $datos = $pdo->query($sql)->fetchAll();
        break;

    case 'notas':
        $titulo = 'Notas';
        $sql = "SELECT Estudiantes.Alumno, Materias.Materia, Notas.1erParcial, 2doParcial, 3erParcial From Estudiantes, Materias, Notas Where Estudiantes.IDAlumno=Notas.IDAlumno and Materias.IDMateria=Notas.IDMateria";
        $datos = $pdo->query($sql)->fetchAll();
        break;

    default:
        $titulo = 'Selecciona una opción del menú.';
        break;
}
?>

<html>
</head>
<link rel="stylesheet" href="estiloDB.css">
<body>

<h1>Gestor Académico</h1>

<div class="nav">
    <form method="get"><input type="hidden" name="vista" value="alumnos"><button>Ver Alumnos</button></form>
    <form method="get"><input type="hidden" name="vista" value="materias"><button>Ver Materias</button></form>
    <form method="get"><input type="hidden" name="vista" value="notas"><button>Ver Notas</button></form>
</div>

<h2><?= htmlspecialchars($titulo) ?></h2>

<?php if ($vista !== 'inicio' && empty($datos)): ?>
    <div class="empty">No hay datos disponibles para esta vista.</div>
<?php elseif (!empty($datos)): ?>
    <table>
        <thead>
            <tr>
                <?php foreach (array_keys($datos[0]) as $col): ?>
                    <th><?= htmlspecialchars($col) ?></th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($datos as $fila): ?>
                <tr>
                    <?php foreach ($fila as $valor): ?>
                        <td><?= htmlspecialchars($valor) ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>