<?php

$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $mensaje = htmlspecialchars($_POST['mensaje'] ?? '');

    // Ejemplo básico de validación y simulación de envío
    if (empty($nombre) || empty($email) || empty($mensaje)) {
        $message = '<p style="color: red; text-align: center;">Por favor, rellena todos los campos.</p>';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = '<p style="color: red; text-align: center;">Formato de correo electrónico inválido.</p>';
    } else {
        // Aquí iría la lógica para enviar el correo electrónico
        // Por ejemplo, usando la función mail() de PHP (requiere configuración del servidor)
        // $to = "terabicontacto@gmail.com";
        // $subject = "Nuevo mensaje de contacto de " . $nombre;
        // $headers = "From: " . $email . "\r\n";
        // $headers .= "Reply-To: " . $email . "\r\n";
        // $headers .= "Content-type: text/html; charset=UTF-8\r\n";
        // $email_body = "
        //     <h2>Nuevo mensaje de contacto</h2>
        //     <p><strong>Nombre:</strong> {$nombre}</p>
        //     <p><strong>Email:</strong> {$email}</p>
        //     <p><strong>Mensaje:</strong><br>{$mensaje}</p>
        // ";

        // if (mail($to, $subject, $email_body, $headers)) {
        //     $message = '<p style="color: green; text-align: center;">¡Gracias por tu mensaje! Nos pondremos en contacto pronto.</p>';
        // } else {
        //     $message = '<p style="color: red; text-align: center;">Hubo un error al enviar tu mensaje. Por favor, inténtalo de nuevo más tarde.</p>';
        // }

        // Para este ejemplo, solo mostramos un mensaje de éxito simulado:
        $message = '<p style="color: green; text-align: center;">¡Gracias por tu mensaje!</p>';
        // Limpiar campos después de un envío exitoso (opcional)
        $_POST['nombre'] = $_POST['email'] = $_POST['mensaje'] = '';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto- GalaxyTravel</title>
   <link rel="stylesheet" href="styles/style_contacto.css">
    </head>
<body>
   
    <div class="container">
        <header class="header">
           
        
        </header>

        <section class="contact-info-section">
            <h1 class="mainTitle">Contacto</h1>
            <p class="subTitle">Si tienes alguna duda o sugerencia, no dudes en contactarnos a través de los siguientes medios:</p>
            <p class="contact-detail"><strong>Correo electrónico:</strong> GalaxyTravel@gmail.com</p>
            <p class="contact-detail"><strong>Teléfono:</strong> +58 412-6080000</p>
        </section>

        <section class="contact-form-section">
            <h2 class="form-title">Formulario de Contacto</h2>
            <?php echo $message; // Muestra el mensaje de éxito/error ?>
            <form class="contact-form" method="POST" action="">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" id="nombre" name="nombre" class="form-input" value="<?php echo htmlspecialchars($_POST['nombre'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" class="form-input" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label for="mensaje">Mensaje:</label>
                    <textarea id="mensaje" name="mensaje" class="form-textarea"><?php echo htmlspecialchars($_POST['mensaje'] ?? ''); ?></textarea>
                </div>
                <button type="submit" class="btn-submit">Enviar Mensaje</button>
            </form>
        </section>

        <footer class="footer">
            <button class="btn-back" onclick="window.history.back()">Volver a la página principal</button>
            <p class="copyright">© GALAXYTRAVEL 2025</p>
        </footer>
    </div>
 <script>
        const cursor = document.querySelector('.cursor');
        const explosion = document.querySelector('.explosion');
        const sideMenu = document.querySelector('.side-menu');
        const menuBtnInput = document.querySelector('#menuBtn input[type="checkbox"]');
        const menuLinks = document.querySelectorAll('.side-menu .menu a');

        document.addEventListener('mousemove', e => {
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';
        });

        document.addEventListener('click', e => {
            explosion.style.left = e.clientX + 'px';
            explosion.style.top = e.clientY + 'px';
            explosion.style.display = 'block';
            explosion.style.animation = 'none'; 
            void explosion.offsetWidth; 
            explosion.style.animation = 'meniItemClick 0.3s forwards'; 
            setTimeout(() => {
                explosion.style.display = 'none';
            }, 300);
        });

        menuBtnInput.addEventListener('change', function() {
            const menu = sideMenu.querySelector('.menu');
            if (this.checked) {
                menu.style.display = 'block'; 
                menu.style.opacity = '0';
                menu.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    menu.style.transition = 'opacity 0.3s ease-out, transform 0.3s ease-out';
                    menu.style.opacity = '1';
                    menu.style.transform = 'translateY(0)';
                }, 50);
            } else {
                menu.style.transition = 'opacity 0.3s ease-in, transform 0.3s ease-in';
                menu.style.opacity = '0';
                menu.style.transform = 'translateY(20px)';
                setTimeout(() => {
                    menu.style.display = 'none'; 
                }, 300); 
            }
        });

        document.addEventListener('click', function(event) {
            const isClickInsideMenu = sideMenu.contains(event.target);
            const isMenuOpen = menuBtnInput.checked;

            if (!isClickInsideMenu && isMenuOpen) {
                menuBtnInput.checked = false; 
                menuBtnInput.dispatchEvent(new Event('change'));
            }
        });

        const hoverableElements = document.querySelectorAll('.nav-item, .side-menu .menu a, .btn-submit, .btn-back, #menuBtn');

        hoverableElements.forEach(item => {
            item.addEventListener('mouseenter', () => {
                cursor.style.transform = 'scale(1.5)';
                cursor.style.backgroundColor = 'white';
                cursor.style.mixBlendMode = 'difference';
                cursor.style.borderColor = 'transparent';
            });

            item.addEventListener('mouseleave', () => {
                cursor.style.transform = 'scale(1)';
                cursor.style.backgroundColor = 'transparent';
                cursor.style.mixBlendMode = 'normal';
                cursor.style.borderColor = 'white';
            });
        });

        const mainTitle = document.querySelector('.mainTitle');
        if (mainTitle) {
            mainTitle.addEventListener('mouseenter', () => {
                cursor.style.transform = 'scale(1.4)';
                cursor.style.backgroundColor = 'white';
                cursor.style.mixBlendMode = 'difference';
                cursor.style.borderColor = 'transparent';
            });

            mainTitle.addEventListener('mouseleave', () => {
                cursor.style.transform = 'scale(1)';
                cursor.style.backgroundColor = 'transparent';
                cursor.style.mixBlendMode = 'normal';
                cursor.style.borderColor = 'white';
            });
        }
    </script>
    </body>
</html>