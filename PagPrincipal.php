<?php

session_start();
if (!isset($_SESSION['alumno'])) {
    header("Location: login.php");
    exit;
}

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
        $sql = "SELECT Estudiantes.Alumno, Materias.Materia, Notas.PrimerParcial, SegundoParcial, TercerParcial From Estudiantes, Materias, Notas Where Estudiantes.IDAlumno=Notas.IDAlumno and Materias.IDMateria=Notas.IDMateria";
        $datos = $pdo->query($sql)->fetchAll();

        // Calcular promedios por alumno
        $promedios = [];
        foreach ($datos as $fila) {
            $alumno = $fila['Alumno'];
            $promedio = round((
                $fila['PrimerParcial'] + 
                $fila['SegundoParcial'] + 
                $fila['TercerParcial']
            ) / 3, 2);
        
            if (!isset($promedios[$alumno])) {
                $promedios[$alumno] = [];
            }
            $promedios[$alumno][] = $promedio;
        }

        // Promedio final por alumno (promedio de sus materias)
        $promediosFinales = [];
        foreach ($promedios as $alumno => $lista) {
            $promediosFinales[$alumno] = round(array_sum($lista) / count($lista), 2);
        }

        // Calcular el mejor promedio
        $mejorPromedio = max($promediosFinales);

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
    <form action="admin.php" method="get"><button type="submit">Administrar Datos</button></form>
    <form action="logout.php" method="post" style="display:inline;"><button type="submit">Cerrar Sesión</button></form>
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

<?php if ($vista === 'notas'): ?>
    <h3>Promedios por Alumno</h3>
    <ul>
        <?php foreach ($promediosFinales as $alumno => $prom): ?>
            <li><?= htmlspecialchars($alumno) ?>: <?= $prom ?></li>
        <?php endforeach; ?>
    </ul>

    <h3>Mejor Promedio General: <?= $mejorPromedio ?></h3>
<?php endif; ?>

</body>
</html>