async function fetching(tipo, datos) {
    const uri = base_url_server + 'src/control/Reservas.php?tipo='+tipo;
    const response = await fetch(uri, { method: 'POST',mode: 'cors', cache: 'no-cache', body: datos});
    if (!response.ok) { throw new Error(`Error HTTP: ${response.status}`); }
    return response;
}
document.addEventListener('DOMContentLoaded', function(){
    listarReservas();
});

async function registrarReserva() {
    const frmRegistrar = document.getElementById('frm_new_reserva');
    try {
        const datos = new FormData(frm_new_reserva);
        datos.append('sesion', session_session); 
        datos.append('token', token_token); 
        const respuesta = await fetching('registrarReserva', datos);
        const json = await respuesta.json();
        if (json.status) {
            frmRegistrar.reset();
            let modalEl = document.getElementById("modalNuevaReserva");
            let modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();
            Swal.fire({
                icon: 'success',
                title: 'Registro',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                timer: 1000,
                showConfirmButton: false
            });
            listarReservas();
        } else if (json.memsaje === "Error_Sesion") {
            alerta_sesion(); 
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                timer: 1000,
                showConfirmButton: false
            });
        }
    } catch (e) {
    console.log('error function' + e);
    }
}

async function listarReservas() {
try {
    let dates = new FormData();
    dates.append('sesion', session_session); 
    dates.append('token', token_token); 
    const respuesta = await fetching('listarReservas', dates);
    const json = await respuesta.json();
    let tbody = document.getElementById("tbody-reservas");
    if(json.status){
            tbody.innerHTML= '';
            let datos = json.contenido;
            let cont = 0;
            datos.forEach(item => {
                let nuevaFila =  document.createElement("tr");
                nuevaFila.id = "fila" +item.id_reserva;
                cont ++;
                nuevaFila.innerHTML = `
                <td class="fw-bold">${cont}</td>
                <td>${item.username}</td>
                <td><span class="badge bg-info text-dark">${item.id_habitacion}</span></td>
                <td>${item.id_hotel}</td>
                <td>${item.fecha_inicio}</td>
                <td>${item.fecha_fin}</td>
                <td>${item.status}</td>
                <td class="fw-bold text-success">${item.monto_total}</td>
                <td>${item.options}</td>
                `;
                tbody.appendChild(nuevaFila);
        });
    }else{
        console.log(json.mensaje);
    }
} catch (e) {
    console.log('erro function  || ' + e); 
} 
}

async function listarReserva(id){
    let data = document.getElementById("data");
    let habitacion = document.getElementById("habitacion-n");
    let hotel = document.getElementById("hotel-n");
    let fecha_inicio = document.getElementById("fechaInicio-n");
    let fecha_fin = document.getElementById("fechaFin-n");
    let monto = document.getElementById("monto-n");
    let estado = document.getElementById("estado");
    try {
    let informacion = new FormData();
    informacion.append('sesion', session_session); 
    informacion.append('token', token_token); 
    informacion.append('id',id);
    const respuesta = await fetching('obtenerReserva', informacion);
    const json = await respuesta.json();
    if(json.status){
    let datos = json.contenido;
       data.value = id;
       habitacion.value = datos.id_habitacion;
       hotel.value = datos.id_hotel;
       fecha_inicio.value = datos.fecha_inicio;
       fecha_fin.value = datos.fecha_fin;
       monto.value = datos.monto_total;
       estado.value = datos.estado;
    }else{
     console.log(json.mensaje);
    }
    } catch (e) {
        console.log('error function ||' + e);
    }
}

async function actualizarReserva() {
    const form = document.getElementById('frm_act_reserva');
    try {
        const datos = new FormData(frm_act_reserva);
        datos.append('sesion', session_session); 
        datos.append('token', token_token); 
        const respuesta = await fetching('actualizar', datos);
        const json = await respuesta.json();
        if (json.status) {
            form.reset();
            let modalEl = document.getElementById("modalActualizarReserva");
            let modal = bootstrap.Modal.getInstance(modalEl);
            modal.hide();
            Swal.fire({
                icon: 'success',
                title: 'Actualizado',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                timer: 1000,
                showConfirmButton: false
            });
            listarReservas();
        } else if (json.memsaje === "Error_Sesion") {
            alerta_sesion(); 
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: json.mensaje,
                confirmButtonClass: 'btn btn-confirm mt-2',
                timer: 1000,
                showConfirmButton: false
            });
        }
    } catch (e) {
    console.log('error function' + e);
    }
}
