// ===== CONFIGURACIÓN DE LA API =====
const API_CONFIG = {
    baseURL: 'http://localhost:8888/hoteles/src/control/apiController.php', // Cambiar por tu dominio
    token: '83aef4639fa44974ec9186d339b25d6a56c3367be5b077e856a4bb85159e5e12-20251030-1' // Tu token de acceso
};

// ===== CACHE DE DATOS =====
let hotelesCache = [];

// ===== FUNCIONES AUXILIARES =====

/**
 * Normaliza texto para comparaciones (sin tildes, minúsculas)
 */
function normalizarTexto(texto) {
    return texto
        .toLowerCase()
        .normalize("NFD")
        .replace(/[\u0300-\u036f]/g, "");
}

/**
 * Obtiene el icono según el tipo de habitación
 */
function obtenerIconoHabitacion(tipo) {
    const tipoNormalizado = normalizarTexto(tipo);
    if (tipoNormalizado.includes("suite") || tipoNormalizado.includes("penthouse")) return "👑";
    if (tipoNormalizado.includes("simple")) return "🛏️";
    if (tipoNormalizado.includes("doble") || tipoNormalizado.includes("familiar")) return "🛏️🛏️";
    return "🚪";
}

/**
 * Mostrar loader
 */
function mostrarLoader(show = true) {
    const resultados = document.getElementById('resultados');
    if (!resultados) return;
    
    if (show) {
        resultados.innerHTML = `
            <div style="grid-column: 1/-1; text-align: center; padding: 3rem;">
                <div style="font-size: 3rem; margin-bottom: 1rem;">⏳</div>
                <p style="color: var(--text-secondary); font-size: 1.1rem;">Cargando información...</p>
            </div>
        `;
    }
}

// ===== FUNCIONES DE API =====

/**
 * Realizar petición a la API
 */
async function fetchAPI(endpoint, method = 'GET', body = null) {
    try {
        const url = `${API_CONFIG.baseURL}?tipo=${endpoint}&token=${API_CONFIG.token}`;
        
        const options = {
            method: method,
            headers: {
                'Content-Type': 'application/json'
            }
        };
        
        if (body && method === 'POST') {
            options.body = JSON.stringify(body);
        }
        
        const response = await fetch(url, options);
        const data = await response.json();
        
        if (!data.status) {
            console.error('Error en API:', data.msg);
            return { success: false, msg: data.msg, data: [] };
        }
        
        return { success: true, data: data.contenido || [], msg: data.msg };
    } catch (error) {
        console.error('Error de conexión:', error);
        return { 
            success: false, 
            msg: 'Error de conexión con el servidor', 
            data: [] 
        };
    }
}

/**
 * Obtener todos los hoteles desde la API
 */
async function obtenerTodosHoteles() {
    mostrarLoader(true);
    const resultado = await fetchAPI('verTodosHoteles');
    
    if (resultado.success) {
        hotelesCache = resultado.data;
        return resultado.data;
    }
    
    mostrarError('No se pudieron cargar los hoteles');
    return [];
}

/**
 * Buscar hoteles por nombre o ubicación
 */
async function buscarHotelesPorNombre(termino) {
    mostrarLoader(true);
    const resultado = await fetchAPI('buscarHotelesPorNombre', 'POST', { termino });
    
    if (resultado.success) {
        return resultado.data;
    }
    
    return [];
}

/**
 * Buscar habitaciones por tipo
 */
async function buscarHabitacionesPorTipo(tipo_habitacion) {
    mostrarLoader(true);
    const resultado = await fetchAPI('buscarHabitacionesPorTipo', 'POST', { tipo_habitacion });
    
    if (resultado.success) {
        return resultado.data;
    }
    
    return [];
}

/**
 * Obtener hotel por ID
 */
async function obtenerHotelPorId(hotelId) {
    const url = `${API_CONFIG.baseURL}?tipo=verHotelPorId&token=${API_CONFIG.token}&hotel_id=${hotelId}`;
    
    try {
        const response = await fetch(url);
        const data = await response.json();
        
        if (data.status) {
            return data.contenido;
        }
        
        return null;
    } catch (error) {
        console.error('Error:', error);
        return null;
    }
}

// ===== FUNCIONES DE RENDERIZADO =====

/**
 * Renderiza cards de hoteles
 */
function renderizarHoteles(hotelesArray) {
    const contenedor = document.getElementById('resultados');
    
    if (!contenedor) return;
    
    contenedor.innerHTML = '';
    
    hotelesArray.forEach(hotel => {
        const habitacionesDisponibles = hotel.habitaciones.filter(h => h.disponible).length;
        const precioMinimo = hotel.habitaciones.length > 0 
            ? Math.min(...hotel.habitaciones.map(h => h.precio))
            : 0;
        
        const card = document.createElement('div');
        card.className = 'hotel-card';
        card.innerHTML = `
            <h3>🏨 ${hotel.nombre}</h3>
            <div class="hotel-ubicacion">
                📍 ${hotel.ubicacion}
            </div>
            
            <p class="hotel-descripcion">${hotel.descripcion}</p>
            <div class="hotel-stats">
                <div class="stat">
                    <span class="stat-value">${hotel.habitaciones.length}</span>
                    <span class="stat-label">Habitaciones</span>
                </div>
                <div class="stat">
                    <span class="stat-value">${habitacionesDisponibles}</span>
                    <span class="stat-label">Disponibles</span>
                </div>
                <div class="stat">
                    <span class="stat-value">s/ ${precioMinimo}</span>
                    <span class="stat-label">Desde</span>
                </div>
            </div>
            <a href="habitaciones.html?id=${hotel.id}" class="btn-primary">
                Ver habitaciones →
            </a>
        `;
        
        contenedor.appendChild(card);
    });
}

/**
 * Renderiza habitaciones con su hotel (para búsqueda por tipo)
 */
function renderizarHabitacionesConHotel(resultados) {
    const contenedor = document.getElementById('resultados');
    
    if (!contenedor) return;
    
    contenedor.innerHTML = '';
    
    resultados.forEach(item => {
        const hotel = item.hotel;
        const habitacion = item.habitacion;
        
        const card = document.createElement('div');
        card.className = 'habitacion-search-card';
        
        const disponibilidadClass = habitacion.disponible ? 'disponible' : 'no-disponible';
        const disponibilidadTexto = habitacion.disponible ? '✓ Disponible' : '✗ No disponible';
        
        card.innerHTML = `
            <div class="habitacion-tipo">
                ${obtenerIconoHabitacion(habitacion.tipo)} ${habitacion.tipo}
            </div>
            <div class="habitacion-hotel">
                🏨 ${hotel.nombre} - ${hotel.ubicacion}
            </div>
            <div class="habitacion-precio">
                s/${habitacion.precio}
                <span class="precio-noche">/ noche</span>
            </div>
            <span class="disponibilidad ${disponibilidadClass}">
                ${disponibilidadTexto}
            </span>
            <div class="servicios-lista">
                ${habitacion.servicios.map(servicio => 
                    `<span class="servicio-tag">✓ ${servicio}</span>`
                ).join('')}
            </div>
        `;
        
        contenedor.appendChild(card);
    });
}

/**
 * Muestra u oculta el mensaje de "sin resultados"
 */
function mostrarSinResultados(mostrar) {
    const elemento = document.getElementById('sinResultados');
    if (elemento) {
        elemento.style.display = mostrar ? 'block' : 'none';
    }
}

/**
 * Actualiza el mensaje de filtro activo
 */
function actualizarFiltroActivo(texto) {
    const elemento = document.getElementById('filtroActivo');
    if (elemento) {
        if (texto) {
            elemento.textContent = texto;
            elemento.classList.add('show');
        } else {
            elemento.classList.remove('show');
        }
    }
}

/**
 * Mostrar mensaje de error
 */
function mostrarError(mensaje) {
    const contenedor = document.getElementById('resultados');
    if (contenedor) {
        contenedor.innerHTML = `
            <div style="grid-column: 1/-1;" class="error-mensaje">
                <div class="error-icon">⚠️</div>
                <h3>Error</h3>
                <p>${mensaje}</p>
            </div>
        `;
    }
}

// ===== FUNCIONES DE FILTRADO LOCAL =====

/**
 * Filtra hoteles localmente (desde cache)
 */
function filtrarHotelesLocal(termino) {
    const terminoNormalizado = normalizarTexto(termino);
    
    return hotelesCache.filter(hotel => {
        const nombreNormalizado = normalizarTexto(hotel.nombre);
        const ubicacionNormalizada = normalizarTexto(hotel.ubicacion);
        
        return nombreNormalizado.includes(terminoNormalizado) || 
               ubicacionNormalizada.includes(terminoNormalizado);
    });
}

/**
 * Busca habitaciones localmente por tipo
 */
function buscarHabitacionesPorTipoLocal(termino) {
    const terminoNormalizado = normalizarTexto(termino);
    const resultados = [];
    
    hotelesCache.forEach(hotel => {
        hotel.habitaciones.forEach(habitacion => {
            const tipoNormalizado = normalizarTexto(habitacion.tipo);
            
            if (tipoNormalizado.includes(terminoNormalizado)) {
                resultados.push({ 
                    hotel: {
                        id: hotel.id,
                        nombre: hotel.nombre,
                        ubicacion: hotel.ubicacion
                    },
                    habitacion: habitacion 
                });
            }
        });
    });
    
    return resultados;
}

// ===== LÓGICA PARA index.html =====

/**
 * Inicializa la página principal
 */
async function inicializarPaginaPrincipal() {
    const filtroHoteles = document.getElementById('filtroHoteles');
    const filtroHabitacion = document.getElementById('filtroHabitacion');
    
    if (!filtroHoteles || !filtroHabitacion) return;
    
    // Cargar todos los hoteles al inicio
    const hoteles = await obtenerTodosHoteles();
    renderizarHoteles(hoteles);
    mostrarSinResultados(false);
    
    // Debounce para evitar muchas peticiones
    let timeoutHoteles;
    let timeoutHabitaciones;
    
    // Event listener para filtro de hoteles
    filtroHoteles.addEventListener('input', async (e) => {
        const termino = e.target.value.trim();
        
        // Limpiar el otro filtro
        filtroHabitacion.value = '';
        
        // Cancelar timeout anterior
        clearTimeout(timeoutHoteles);
        
        if (termino === '') {
            // Si está vacío, mostrar todos los hoteles desde cache
            renderizarHoteles(hotelesCache);
            mostrarSinResultados(false);
            actualizarFiltroActivo('');
        } else {
            // Mostrar loader
            mostrarLoader(true);
            
            // Esperar 500ms antes de hacer la búsqueda
            timeoutHoteles = setTimeout(async () => {
                // Buscar en la API
                const hotelesFiltrados = await buscarHotelesPorNombre(termino);
                
                if (hotelesFiltrados.length > 0) {
                    renderizarHoteles(hotelesFiltrados);
                    mostrarSinResultados(false);
                    actualizarFiltroActivo(`📍 Mostrando ${hotelesFiltrados.length} hotel(es) que coinciden con "${termino}"`);
                } else {
                    document.getElementById('resultados').innerHTML = '';
                    mostrarSinResultados(true);
                    actualizarFiltroActivo('');
                }
            }, 500);
        }
    });
    
    // Event listener para filtro de habitaciones
    filtroHabitacion.addEventListener('input', async (e) => {
        const termino = e.target.value.trim();
        
        // Limpiar el otro filtro
        filtroHoteles.value = '';
        
        // Cancelar timeout anterior
        clearTimeout(timeoutHabitaciones);
        
        if (termino === '') {
            // Si está vacío, mostrar todos los hoteles desde cache
            renderizarHoteles(hotelesCache);
            mostrarSinResultados(false);
            actualizarFiltroActivo('');
        } else {
            // Mostrar loader
            mostrarLoader(true);
            
            // Esperar 500ms antes de hacer la búsqueda
            timeoutHabitaciones = setTimeout(async () => {
                // Buscar en la API
                const habitacionesEncontradas = await buscarHabitacionesPorTipo(termino);
                
                if (habitacionesEncontradas.length > 0) {
                    renderizarHabitacionesConHotel(habitacionesEncontradas);
                    mostrarSinResultados(false);
                    actualizarFiltroActivo(`🛏️ Mostrando ${habitacionesEncontradas.length} habitación(es) tipo "${termino}"`);
                } else {
                    document.getElementById('resultados').innerHTML = '';
                    mostrarSinResultados(true);
                    actualizarFiltroActivo('');
                }
            }, 500);
        }
    });
}

// ===== LÓGICA PARA habitaciones.html =====

/**
 * Obtiene el hotel por ID desde la URL
 */
function obtenerIdHotelDesdeURL() {
    const params = new URLSearchParams(window.location.search);
    const hotelId = parseInt(params.get('id'));
    return hotelId || null;
}

/**
 * Renderiza la información del hotel
 */
function renderizarInfoHotel(hotel) {
    const contenedor = document.getElementById('hotelInfo');
    
    if (!contenedor) return;
    
    contenedor.innerHTML = `
        <h2>${hotel.nombre}</h2>
        <div class="ubicacion">📍 ${hotel.ubicacion}</div>
        <div class="descripcion">${hotel.descripcion}</div>
    `;
}

/**
 * Renderiza las habitaciones del hotel
 */
function renderizarHabitacionesHotel(habitaciones) {
    const contenedor = document.getElementById('habitacionesContainer');
    
    if (!contenedor) return;
    
    contenedor.innerHTML = '';
    
    if (!habitaciones || habitaciones.length === 0) {
        contenedor.innerHTML = `
            <div style="grid-column: 1/-1; text-align: center; padding: 3rem;">
                <p style="color: var(--text-secondary); font-size: 1.1rem;">No hay habitaciones disponibles para este hotel.</p>
            </div>
        `;
        return;
    }
    
    habitaciones.forEach(habitacion => {
        const card = document.createElement('div');
        card.className = 'habitacion-card';
        
        const disponibilidadClass = habitacion.disponible ? 'disponible' : 'no-disponible';
        const disponibilidadTexto = habitacion.disponible ? '✓ Disponible' : '✗ No disponible';
        
        card.innerHTML = `
            <div class="habitacion-header">
                <h3>${obtenerIconoHabitacion(habitacion.tipo)} ${habitacion.tipo}</h3>
                <span class="disponibilidad ${disponibilidadClass}">
                    ${disponibilidadTexto}
                </span>
            </div>
            <div class="habitacion-precio">
                s/ ${habitacion.precio}
                <span class="precio-noche"> </span>
            </div>
            ${habitacion.capacidad ? `<p style="color: var(--text-secondary); margin: 0.5rem 0;">Capacidad: ${habitacion.capacidad}</p>` : ''}
            ${habitacion.cantidad_disponible ? `<p style="color: var(--text-secondary); margin: 0.5rem 0;">Disponibles: ${habitacion.cantidad_disponible}</p>` : ''}
            <div class="servicios-lista">
                ${habitacion.servicios.map(servicio => 
                    `<span class="servicio-tag">✓ ${servicio}</span>`
                ).join('')}
            </div>
        `;
        
        contenedor.appendChild(card);
    });
}

/**
 * Muestra mensaje de error si no se encuentra el hotel
 */
function mostrarErrorHotel() {
    const hotelInfo = document.getElementById('hotelInfo');
    const habitacionesContainer = document.getElementById('habitacionesContainer');
    const errorMensaje = document.getElementById('errorMensaje');
    
    if (hotelInfo) hotelInfo.style.display = 'none';
    if (habitacionesContainer) habitacionesContainer.style.display = 'none';
    if (errorMensaje) errorMensaje.style.display = 'block';
}

/**
 * Inicializa la página de habitaciones
 */
async function inicializarPaginaHabitaciones() {
    const hotelId = obtenerIdHotelDesdeURL();
    
    if (!hotelId) {
        mostrarErrorHotel();
        return;
    }
    
    // Mostrar loader temporal
    const hotelInfo = document.getElementById('hotelInfo');
    const habitacionesContainer = document.getElementById('habitacionesContainer');
    
    if (hotelInfo) {
        hotelInfo.innerHTML = `
            <div style="text-align: center; padding: 2rem;">
                <div style="font-size: 2rem; margin-bottom: 1rem;">⏳</div>
                <p>Cargando información del hotel...</p>
            </div>
        `;
    }
    
    // Obtener datos del hotel
    const data = await obtenerHotelPorId(hotelId);
    
    if (!data || !data.hotel) {
        mostrarErrorHotel();
        return;
    }
    
    renderizarInfoHotel(data.hotel);
    renderizarHabitacionesHotel(data.habitaciones);
}

// ===== INICIALIZACIÓN =====

/**
 * Detecta qué página estamos cargando e inicializa la correcta
 */
document.addEventListener('DOMContentLoaded', () => {
    const path = window.location.pathname;
    
    if (path.includes('habitaciones.html')) {
        inicializarPaginaHabitaciones();
    } else {
        inicializarPaginaPrincipal();
    }
});