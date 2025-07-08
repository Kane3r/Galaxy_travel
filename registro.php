<?php
$servidor = "localhost";
$usuario = "root";
$clave = "";
$BaseDeDatos = "galaxy_travel";

$enlace = mysqli_connect($servidor, $usuario, $clave, $BaseDeDatos);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Cliente</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form action="#" method="post">
    <input type="text" name="usuario" placeholder="Nombre de usuario" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>
    <input type="text" name="nombre" placeholder="Nombre completo" required>
    <input type="number" name="edad" placeholder="Edad" required>
    <input type="text" name="cedula" placeholder="Cédula de identidad" required>
    <input type="submit" name="registro" value="Registrar">
    <input type="reset" value="Limpiar">
    <button type="button" class="button2" onclick="window.location.href='index.php'">Volver al inicio de sesión</button>
</form>

<?php
if (isset($_POST['registro'])) {
    $usuarioInput = mysqli_real_escape_string($enlace, $_POST['usuario']);
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
    $nombre = mysqli_real_escape_string($enlace, $_POST['nombre']);
    $edad = (int)$_POST['edad'];
    $cedula = mysqli_real_escape_string($enlace, $_POST['cedula']);
    $fechaRegistro = date("Y-m-d");

    // Verificar si el usuario o la cédula ya existen
    $verificar = "SELECT * FROM clientes WHERE usuario = '$usuarioInput' OR cedula_identidad = '$cedula'";
    $resultado = mysqli_query($enlace, $verificar);

    if (mysqli_num_rows($resultado) > 0) {
        echo "<script>alert('El nombre de usuario o la cédula ya están registrados');</script>";
    } else {
        $insertar = "INSERT INTO clientes (usuario, contrasena, nombre, edad, cedula_identidad, fecha_registro)
                     VALUES ('$usuarioInput', '$contrasena', '$nombre', $edad, '$cedula', '$fechaRegistro')";
        if (mysqli_query($enlace, $insertar)) {
            echo "<script>alert('Registro exitoso'); window.location='index.php';</script>";
        } else {
            echo "<script>alert('Error al registrar');</script>";
        }
    }
}
?>

</body>
</html>
