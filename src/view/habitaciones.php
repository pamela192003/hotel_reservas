<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Habitaciones del Hotel</title>
    <link rel="stylesheet" href="styles.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
      <script>
        const base_url = '<?php echo BASE_URL; ?>';
        const base_url_server = '<?php echo BASE_URL_SERVER; ?>';
        const session_session = '<?php echo $_SESSION['sesion_id']; ?>';
        const token_token = '<?php echo $_SESSION['sesion_token']; ?>';
</script>
</head>
<body>
    <header>
  <div class="container text-center">
    <div class="header-icon">
      <i class="fa-solid fa-hotel"></i>
    </div>
    <h1>Cliente API - HotelSeek</h1>
    <p class="subtitle">Habitaciones Disponibles</p>
  </div>
</header>

    <main class="container">
        <!-- Botón de regreso -->
        <div class="navigation">
            <a href="index.html" class="btn-back">
                ← Volver a la búsqueda
            </a>
        </div>

        <!-- Información del hotel -->
        <section id="hotelInfo" class="hotel-info">
            <!-- Se renderizará dinámicamente -->
        </section>

        <!-- Habitaciones del hotel -->
        <section id="habitacionesContainer" class="habitaciones-container">
            <!-- Las habitaciones se renderizarán aquí dinámicamente -->
        </section>

        <!-- Mensaje de error si no se encuentra el hotel -->
        <div id="errorMensaje" class="error-mensaje" style="display: none;">
            <div class="error-icon">⚠️</div>
            <h3>Hotel no encontrado</h3>
            <p>El hotel que buscas no existe o el enlace es incorrecto.</p>
            <a href="index.html" class="btn-primary">Volver al inicio</a>
        </div>
    </main>

    <footer>
        <div class="container">
            <p>&copy; 2025 HotelSeek. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="<?php echo BASE_URL; ?>src/view/js/api.js"></script>
</body>
</html>