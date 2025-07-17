
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
        <div class="header">
          </div>

        <div class="about-us-section">
            <h1 class="mainTitle">Gusto en conocerte</h1>
            <h2 class="subTitle">Somos Galaxy Travel</h2>
            <p class="about-text">
                En **Galaxy Travel**, nuestra misión es llevarte más allá de lo imaginable. Somos una agencia de viajes espacial dedicada a explorar las maravillas del cosmos. Desde las lunas de Júpiter hasta los anillos de Saturno y las misteriosas nebulosas distantes, te ofrecemos experiencias únicas que redefinen la aventura. Con tecnología de punta y un equipo de expertos, garantizamos viajes seguros e inolvidables a los destinos más fascinantes del espacio exterior. ¡Prepárate para despegar y descubrir un universo de posibilidades con nosotros!
            </p>
            <p class="about-text">
                Nuestra pasión por el espacio nos impulsa a innovar constantemente, ofreciendo itinerarios personalizados y adaptados a cada explorador. Creemos que el futuro de los viajes está en las estrellas, y estamos aquí para hacer ese futuro una realidad para ti.
            </p>
        </div>

        <div class="footer">
             <button class="btn-back" onclick="window.history.back()">Volver a la página principal</button>
            <p class="copyright">© GALAXYTRAVEL 2025</p>
            <br>
            <br>
            <br>
            <p class="copyright">&copy; <?php echo date('Y'); ?> Galaxy Travel. Todos los derechos reservados.</p>
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
