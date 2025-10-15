<?php
session_start();
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="estiloDB.css">
    <title>Login</title>
</head>
<body>
<h2>Iniciar Sesión</h2>

<form method="post" action="validar.php">
    <label>Alumno: <input type="text" name="alumno" required></label><br>
    <label>Contraseña: <input type="password" name="password" required></label><br>
    <button type="submit">Ingresar</button>
</form>

<?php if (isset($_GET['error'])): ?>
    <p style="color:red;">Alumno o contraseña incorrectos</p>
<?php endif; ?>

</body>
</html>