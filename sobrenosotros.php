<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nosotros - Galaxy Travel</title>
    <link rel="stylesheet" href="styles/style_sobrenosotros.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="cursor"></div>

    <div class="side-menu">
        <div id="menuBtn">
            <input type="checkbox" />
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="menu">
            <a href="dashboard.php">Inicio</a>
            <a href="viajes.php">Viajes</a>
            <a href="informe.php">Informes</a>
            <a href="logout.php">Salir</a>
            <div class="straight-line"></div>
        </div>
    </div>

    <div class="container">
        <div class="header"></div>

        <div class="about-us-section" style="background: linear-gradient(135deg, #0b0f33 60%, #00bfff 100%); border-radius: 18px; box-shadow: 0 4px 32px rgba(0,0,0,0.12); padding: 32px 24px; margin-bottom: 32px; color: #fff;">
            <h1 class="mainTitle" style="font-size: 2.6rem; color: #fff; text-shadow: 2px 2px 8px #00bfff; margin-bottom: 12px;">¡Gusto en conocerte!</h1>
            <h2 class="subTitle" style="font-size: 2rem; color: #00bfff; margin-bottom: 18px;">Somos <span style="color: #fff; background: #00bfff; border-radius: 8px; padding: 2px 12px;">Galaxy Travel</span></h2>
            <div style="display: flex; flex-wrap: wrap; gap: 32px; align-items: center; justify-content: center;">
                <div style="flex: 1 1 320px; min-width: 220px; max-width: 480px;">
                    <p class="about-text" style="font-size: 1.2rem; margin-bottom: 18px; background: rgba(255,255,255,0.08); border-radius: 8px; padding: 16px; color: #e0e0e0;">
                        En <strong>Galaxy Travel</strong>, nuestra misión es llevarte más allá de lo imaginable. Somos una agencia de viajes espacial dedicada a explorar las maravillas del cosmos. Desde las lunas de Júpiter hasta los anillos de Saturno y las misteriosas nebulosas distantes, te ofrecemos experiencias únicas que redefinen la aventura. Con tecnología de punta y un equipo de expertos, garantizamos viajes seguros e inolvidables a los destinos más fascinantes del espacio exterior.<br><br>
                        <span style="color: #00bfff; font-weight: bold;">¡Prepárate para despegar y descubrir un universo de posibilidades con nosotros!</span>
                    </p>
                    <p class="about-text" style="font-size: 1.1rem; background: rgba(255,255,255,0.05); border-radius: 8px; padding: 14px; color: #c0eaff;">
                        Nuestra pasión por el espacio nos impulsa a innovar constantemente, ofreciendo itinerarios personalizados y adaptados a cada explorador. Creemos que el futuro de los viajes está en las estrellas, y estamos aquí para hacer ese futuro una realidad para ti.
                    </p>
                </div>
                <div style="flex: 1 1 320px; min-width: 220px; max-width: 400px; display: flex; flex-direction: column; gap: 18px; align-items: center;">
                    <img src="assets/img/empresa.png" alt="Empresa" style="width: 100%; max-width: 320px; border-radius: 14px; box-shadow: 0 4px 24px #00bfff55;">
                    <img src="assets/img/oficina.png" alt="Oficina" style="width: 100%; max-width: 320px; border-radius: 14px; box-shadow: 0 4px 24px #00bfff55;">
                </div>
            </div>
            <div style="margin-top: 32px; background: rgba(255,255,255,0.10); border-radius: 8px; padding: 18px; color: #fff;">
                <h3 style="color: #00bfff; margin-bottom: 10px;">Nuestras instalaciones</h3>
                <p style="font-size: 1.1rem; color: #fff;">
                    Nuestra oficina central está ubicada en Virginia, Estados Unidos, específicamente en Arlington, 2110 Washington Blvd.
                </p>
            </div>
        </div>

        <div class="footer" style="margin-top: 48px;">
            <button class="btn-back" style="background: #00bfff; color: #fff; border: none; border-radius: 8px; padding: 10px 28px; font-size: 1.1rem; cursor: pointer; box-shadow: 0 2px 8px #00bfff44; margin-bottom: 18px;" onclick="window.history.back()">Volver a la página principal</button>
            <p class="copyright" style="color: #00bfff; font-size: 1.05rem;">© GALAXYTRAVEL 2025</p>
            <p class="copyright" style="color: #00bfff; font-size: 1.05rem;">&copy; <?php echo date('Y'); ?> Galaxy Travel. Todos los derechos reservados.</p>
        </div>
    </div>

    <div id="WebGL-output"></div>
    <div class="explosion"></div>

    <script>
        const cursor = document.querySelector(".cursor");
        const explosion = document.querySelector(".explosion");
        const menuBtn = document.getElementById("menuBtn");
        const menu = document.querySelector(".side-menu .menu");

        document.addEventListener("mousemove", (e) => {
            cursor.style.left = e.clientX + "px";
            cursor.style.top = e.clientY + "px";
        });

        document.addEventListener("click", (e) => {
            explosion.style.left = e.clientX + "px";
            explosion.style.top = e.clientY + "px";
            explosion.style.display = "block";
            explosion.style.animation = "none"; 
            void explosion.offsetWidth; 
            explosion.style.animation = "meniItemClick 0.3s"; 
            setTimeout(() => {
                explosion.style.display = "none"; 
            }, 300);
        });

        menuBtn.addEventListener('change', function() {
            if (this.checked) {
                menu.style.display = 'block';
            } else {
                menu.style.display = 'none';
            }
        });

        document.addEventListener('click', function(event) {
            const isClickInsideMenu = menu.contains(event.target);
            const isClickOnMenuBtn = menuBtn.contains(event.target);
            if (!isClickInsideMenu && !isClickOnMenuBtn && menuBtn.querySelector('input').checked) {
                menuBtn.querySelector('input').checked = false;
                menu.style.display = 'none';
            }
        });
    </script>
</body>
</html>
