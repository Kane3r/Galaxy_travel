<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

$mensaje_enviado = false;
$error_envio = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'] ?? '';
    $email = $_POST['email'] ?? '';
    $mensaje = $_POST['mensaje'] ?? '';

    $mail = new PHPMailer(true);

    try {
        // Configuración SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'keviinrozo30co@gmail.com'; // ✅ TU correo Gmail
        $mail->Password   = 'm33nc4nt4m1c0ntr4';     // ✅ Contraseña de aplicación
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Remitente y destinatario
        $mail->setFrom($email, $nombre);
        $mail->addAddress('morenojeannerys@gmail.com'); // ✅ Destinatario

        // Contenido
        $mail->isHTML(true);
        $mail->Subject = "Nuevo mensaje de contacto - Galaxy Travel";
        $mail->Body    = "<strong>Nombre:</strong> $nombre<br><strong>Email:</strong> $email<br><strong>Mensaje:</strong><br>$mensaje";

        $mail->send();
        $mensaje_enviado = true;
    } catch (Exception $e) {
        $error_envio = $mail->ErrorInfo;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contáctanos - Galaxy Travel</title>
    <style>
        body {
            background: radial-gradient(circle, #0b0f33 0%, #000000 100%);
            color: #fff;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 40px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #00bfff;
            margin-bottom: 20px;
        }

        form {
            background: rgba(255,255,255,0.05);
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 16px #00bfff55;
            width: 100%;
            max-width: 500px;
        }

        input, textarea {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border: none;
            border-radius: 6px;
            background-color: #1c1c1c;
            color: #fff;
            font-size: 1rem;
        }

        input:focus, textarea:focus {
            outline: none;
            background-color: #222;
            box-shadow: 0 0 5px #00bfff;
        }

        button {
            background-color: #00bfff;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            font-size: 1rem;
            transition: background 0.3s;
        }

        button:hover {
            background-color: #009acd;
        }

        .mensaje {
            margin-top: 20px;
            font-size: 1.1rem;
        }

        .success {
            color: #00ffcc;
        }

        .error {
            color: #ff6f6f;
        }
    </style>
</head>
<body>
    <h1>Contáctanos</h1>

    <?php if ($mensaje_enviado): ?>
        <div class="mensaje success">✅ Tu mensaje ha sido enviado correctamente.</div>
    <?php elseif ($error_envio): ?>
        <div class="mensaje error">❌ Error al enviar el mensaje: <?= htmlspecialchars($error_envio) ?></div>
    <?php endif; ?>

    <form method="post" action="">
        <input type="text" name="nombre" placeholder="Tu nombre completo" required>
        <input type="email" name="email" placeholder="Tu correo electrónico" required>
        <textarea name="mensaje" rows="6" placeholder="Tu mensaje" required></textarea>
        <button type="submit">Enviar mensaje</button>
    </form>
</body>
</html>
