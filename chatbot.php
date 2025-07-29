<?php
session_start();

if (!isset($_SESSION['id'])) {
    echo "<script>
        alert('Debes iniciar sesión para acceder al chat con Astroneer.');
        window.location.href = 'login.php';
    </script>";
    exit();
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Chat con Astroneer</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: radial-gradient(circle at center, #0b0f33, #000);
            color: #f1f1f1;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
        }

        h1 {
            color: #00bfff;
            margin-bottom: 20px;
            text-shadow: 1px 1px 4px #000;
        }

        #chatlog {
            width: 100%;
            max-width: 600px;
            height: 360px;
            overflow-y: auto;
            border: 1px solid #2c2c2c;
            border-radius: 8px;
            background-color: rgba(255, 255, 255, 0.05);
            padding: 15px;
            box-shadow: 0 0 12px #00000055;
        }

        #chatlog div {
            margin-bottom: 12px;
        }

        input[type="text"] {
            width: calc(100% - 110px);
            max-width: 480px;
            padding: 10px;
            border: none;
            border-radius: 6px;
            margin-top: 15px;
            background-color: #1c1c1c;
            color: #fff;
        }

        button {
            padding: 10px 20px;
            margin-top: 15px;
            margin-left: 10px;
            border: none;
            border-radius: 6px;
            background-color: #00bfff;
            color: white;
            cursor: pointer;
            transition: background-color 0.2s ease-in-out;
        }

        button:hover {
            background-color: #009acd;
        }

        .footer-disclaimer {
            margin-top: 60px;
            max-width: 800px;
            font-size: 13px;
            color: #aaaaaa;
            text-align: center;
            line-height: 1.6;
            padding: 0 10px;
        }
    </style>
</head>
<body>
    <h1>Chat con Astroneer</h1>

    <div id="chatlog"></div>

    <div style="display: flex; flex-wrap: wrap; justify-content: center; width: 100%; max-width: 600px;">
        <input type="text" id="userInput" placeholder="Escribe tu mensaje...">
        <button onclick="sendMessage()">Enviar</button>
    </div>

    <div style="width: 100%; max-width: 600px; display: flex; justify-content: center; gap: 16px; margin-top: 32px;">
        <a href="index.html" style="text-decoration: none;">
            <button style="background-color: #00bfff;">Volver al inicio</button>
        </a>
        <a href="?logout=1" style="text-decoration: none;">
            <button style="background-color: #ff4c4c;">Cerrar sesión</button>
        </a>
    </div>

    <div class="footer-disclaimer">
        <p>
            <strong>Cláusula de exención de responsabilidad:</strong><br>
            Galaxy Travel y sus afiliados no se hacen responsables, en ninguna circunstancia, por daños directos, indirectos, incidentales, consecuenciales o especiales que pudieran surgir como resultado de viajes espaciales fallidos, retrasos, fallas tecnológicas, errores en los sistemas de navegación o cualquier otro evento que afecte la integridad del individuo o su propiedad. Al utilizar nuestros servicios, el usuario reconoce y acepta que los viajes interplanetarios conllevan riesgos inherentes, y exonera de toda responsabilidad a Galaxy Travel por cualquier daño, pérdida, lesión, trauma físico, psicológico o material que pudiera ocurrir antes, durante o después de su viaje. El uso de este servicio implica la aceptación expresa de estos términos.
        </p>
    </div>

    <script src="scripts/script_chat.js"></script>
</body>
</html>
