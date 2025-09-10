<?php
$titulo = "Panel de Administración";
?>

<html>
<head>
    <link rel="stylesheet" href="estiloDB.css">
</head>
<body>

<h1><?= htmlspecialchars($titulo) ?></h1>

<div class="admin-menu">
    <ul>
        <form action="admin_alumnos.php" method="get"><button type="submit">Administrar Alumnos</button></form>
        <form action="admin_materias.php" method="get"><button type="submit">Administrar Materias</button></form>
        <form action="admin_notas.php" method="get"><button type="submit">Administrar Notas</button></form>
        <form action="admin_carreras.php" method="get"><button type="submit">Administrar Carreras</button></form>
        <form action="PagPrincipal.php" method="get"><button type="submit">Volver al Inicio</button></form>
    </ul>
</div>

</body>
</html>