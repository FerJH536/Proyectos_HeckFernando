<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="estiloarray.css">
    <meta charset="UTF-8">
    <title>Reporte de Estudiantess</title>
</head>
<body>

<?php
require_once 'funciones.php';
require_once 'datos.php';

$estudianteMejorPromedio = null;
$estudianteMejorPromedio=mejorPromedio($estudiantes);

require 'formato.php';
?>

</body>
</html>