<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Búsqueda de Hoteles</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
<body>
   <header>
  <div class="container text-center">
    <div class="header-icon">
      <i class="fa-solid fa-hotel"></i>
    </div>
    <h1>Cliente API - HotelSeek</h1>
    <p class="subtitle">Encuentra tu alojamiento perfecto con comodidad y estilo</p>
  </div>
</header>


    <main class="container">
        <!-- Sección de Filtros -->
        <section class="filters-section">
            <div class="filter-group">
                <label for="filtroHoteles">
                    <span class="filter-icon">🔍</span>
                    Buscar por hotel o ubicación
                </label>
                <input 
                    type="text" 
                    id="filtroHoteles" 
                    placeholder="Ej: Madrid, Hotel del Sol..."
                    autocomplete="off"
                >
            </div>

            <div class="filter-group">
                <label for="filtroHabitacion">
                    <span class="filter-icon">🛏️</span>
                    Buscar por tipo de habitación
                </label>
                <input 
                    type="text" 
                    id="filtroHabitacion" 
                    placeholder="Ej: simple, doble, suite..."
                    autocomplete="off"
                >
            </div>
        </section>

        <!-- Información del filtro activo -->
        <div id="filtroActivo" class="filtro-activo"></div>

        <!-- Contenedor de resultados -->
        <section id="resultados" class="resultados-grid">
            <!-- Los hoteles o habitaciones se renderizarán aquí dinámicamente -->
        </section>

        <!-- Mensaje cuando no hay resultados -->
        <div id="sinResultados" class="sin-resultados" style="display: none;">
            <div class="sin-resultados-icon">🔍</div>
            <h3>No se encontraron resultados</h3>
            <p>Intenta con otros términos de búsqueda</p>
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