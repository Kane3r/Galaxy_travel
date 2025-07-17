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
    <style>
    @import url("https://fonts.googleapis.com/css?family=Fira+Mono:400");

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      background: radial-gradient(circle, #131111 0%, black 17%, black 27%);
      height: 100vh;
      font-family: "Fira Mono", monospace;
      display: flex;
      flex-direction: column; /* Cambiado a columna para centrar el formulario y el botón */
      justify-content: center;
      align-items: center;
      color: #c1ffea;
      overflow: hidden;
    }

    form {
      background: rgba(10, 10, 10, 0.85);
      padding: 40px 50px;
      border-radius: 12px;
      box-shadow: 0 0 20px 5px #0f4c81;
      width: 320px;
      display: flex;
      flex-direction: column;
      gap: 20px; /* Espacio entre los elementos del formulario */
      border: 1px solid #0f4c81;
      transition: box-shadow 0.3s ease;
      margin-bottom: 20px; /* Añadido margen inferior para separar del nuevo botón */
    }

    form:hover {
      box-shadow: 0 0 30px 8px #3ea0ff;
    }

    input[type="text"],
    input[type="password"] {
      background: transparent;
      border: 2px solid #0f4c81;
      border-radius: 6px;
      padding: 12px 15px;
      color: #c1ffea;
      font-size: 16px;
      transition: border-color 0.3s ease, box-shadow 0.3s ease;
      width: 100%; /* Hacemos que los inputs ocupen todo el ancho */
    }

    input[type="text"]::placeholder,
    input[type="password"]::placeholder {
      color: #7aaedb;
    }

    input[type="text"]:focus,
    input[type="password"]:focus {
      outline: none;
      border-color: #3ea0ff;
      box-shadow: 0 0 8px #3ea0ff;
      background: rgba(15, 76, 129, 0.1);
    }

    input[type="submit"],
    button.button {
      background: #0f4c81;
      border: none;
      border-radius: 6px;
      padding: 12px 20px;
      color: #c1ffea;
      font-weight: 700;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s ease, box-shadow 0.3s ease;
      user-select: none;
      width: 100%; /* Hacemos que los botones ocupen todo el ancho */
    }

    input[type="submit"]:hover,
    button.button:hover {
      background: #3ea0ff;
      box-shadow: 0 0 12px #3ea0ff;
    }

    input[type="submit"]:active,
    button.button:active {
      transform: scale(0.98);
    }

    /* Estilos para el nuevo botón "Volver a la página principal" */
    .btn-volver-principal {
        display: block; /* Para que ocupe su propia línea */
        width: 320px; /* Mismo ancho que el formulario para alineación */
        padding: 12px 20px;
        background-color: #0056b3; /* El color solicitado */
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        text-decoration: none; /* Quita el subrayado del enlace */
        font-size: 16px;
        font-weight: 700;
        text-align: center; /* Centra el texto dentro del botón */
        transition: background-color 0.2s ease-in-out, box-shadow 0.3s ease;
        box-shadow: 0 0 12px rgba(0, 86, 179, 0.5); /* Sombra para el botón */
    }

    .btn-volver-principal:hover {
        background-color: #003f7f; /* Un tono un poco más oscuro al pasar el ratón */
        box-shadow: 0 0 18px rgba(0, 86, 179, 0.7); /* Sombra más pronunciada al pasar el ratón */
    }

    @media (max-width: 400px) {
      form {
        width: 90%;
        padding: 30px 20px;
      }
      .btn-volver-principal {
        width: 90%; /* Ajusta el ancho del botón en pantallas pequeñas */
        padding: 10px 15px; /* Ajusta el padding en pantallas pequeñas */
      }
    }
    </style>
</head>
<body>

<form action="#" method="post">
    <input type="text" name="usuario" placeholder="Nombre de usuario" required>
    <input type="password" name="contrasena" placeholder="Contraseña" required>
    <input type="submit" name="login" value="Iniciar Sesión">
    <button type="button" class="button" onclick="window.location.href='registro.php'">Registrarse</button>
    
</form>

<!-- Nuevo botón para volver a la página principal -->
<a href="index.html" class="btn-volver-principal">Volver a la página principal</a>

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
            echo "<script>window.location.href = 'chatbot.php';</script>";
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
