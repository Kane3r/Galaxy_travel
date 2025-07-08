<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$BaseDeDatos = "galaxy_travel";

$enlace = mysqli_connect($servidor, $usuario, $clave, $BaseDeDatos);
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form action="#" method="post">
    <input type="text" name="usuario" placeholder="Nombre de usuario" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>
    <input type="submit" name="login" value="Iniciar Sesión">
    <button type="button" class="button" onclick="window.location.href='registro.php'">Registrarse</button>
</form>

<?php

if (isset($_POST['login'])) {
    $usuario_input = mysqli_real_escape_string($enlace, $_POST['usuario']);
    $contrasena_input = $_POST['contrasena'];

    $consulta = "SELECT * FROM clientes WHERE usuario='$usuario_input'";
    $resultado = mysqli_query($enlace, $consulta);

    if (mysqli_num_rows($resultado) == 1) {
        $cliente = mysqli_fetch_assoc($resultado);

        if (password_verify($contrasena_input, $cliente['contrasena'])) {
            $_SESSION['usuario'] = $cliente['usuario'];
            $_SESSION['nombre'] = $cliente['nombre'];
            $_SESSION['id'] = $cliente['id'];

            mysqli_close($enlace);
            echo "<script>window.location.href = 'index.php';</script>";
        } else {
            echo "<script>alert('Contraseña incorrecta');</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado');</script>";
    }
}
?>

</body>
</html>
