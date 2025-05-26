<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../resources/css/footer.css">
</head>
<body>

    <footer class="footer">
        <div class="footer-links">
            <div>
            <a href="index.php">Home</a>
            <a href="#">Colaboradores</a>
            </div>
            <div>
            <a href="#" id="openPrivacyPopup">Política de privacidad</a>
            <a href="#" id="openCookiesPopup">Política de cookies</a>
            </div>
            <div>
            <a href="index.php#contact">Contacto y horarios</a>
            <a href="#">Encuéntranos en redes</a>
            <img src="../resources/img/redstarAW.png" alt="Logo">
            </div>
        </div>
        </footer>

        
        <div id="privacyPopup" class="popup-modal">
            <div class="popup-content">
                <span class="popup-close" id="closePrivacyPopup">&times;</span>
                <h2>Política de privacidad</h2>
                <p>
                Su privacidad es importante para nosotros. No recopilamos información personal de los usuarios en este sitio web.
                No usamos ni compartimos datos personales. Si tiene preguntas, por favor contáctenos.
                </p>
            </div>
        </div>

        
        <div id="cookiesPopup" class="popup-modal">
            <div class="popup-content">
                <span class="popup-close" id="closeCookiesPopup">&times;</span>
                <h2>Política de cookies</h2>
                <p>
                Este sitio web no utiliza cookies ni otras tecnologías de seguimiento.
                No almacenamos ni usamos cookies, y no hay seguimiento por terceros.
                Si tiene preguntas, por favor contáctenos.
                </p>
            </div>
        </div>
    </footer>
</body>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const privacyPopup = document.getElementById('privacyPopup');
    const cookiesPopup = document.getElementById('cookiesPopup');

    const openPrivacyBtn = document.getElementById('openPrivacyPopup');
    const closePrivacyBtn = document.getElementById('closePrivacyPopup');

    const openCookiesBtn = document.getElementById('openCookiesPopup');
    const closeCookiesBtn = document.getElementById('closeCookiesPopup');

    openPrivacyBtn.addEventListener('click', (e) => {
      e.preventDefault();
      privacyPopup.style.display = 'block';
    });

    closePrivacyBtn.addEventListener('click', () => {
      privacyPopup.style.display = 'none';
    });

    openCookiesBtn.addEventListener('click', (e) => {
      e.preventDefault();
      cookiesPopup.style.display = 'block';
    });

    closeCookiesBtn.addEventListener('click', () => {
      cookiesPopup.style.display = 'none';
    });

    window.addEventListener('click', (event) => {
      if (event.target === privacyPopup) {
        privacyPopup.style.display = 'none';
      }
      if (event.target === cookiesPopup) {
        cookiesPopup.style.display = 'none';
      }
    });
  });
</script>

</html>