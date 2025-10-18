async function fetching(tipo, datos) {
    const uri = base_url_server + 'src/control/Usuarios.php?tipo='+tipo;
    
    const response = await fetch(uri, {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        body: datos
    });
    if (!response.ok) {
        throw new Error(`Error HTTP: ${response.status}`);
    }
    return response;
}

document.addEventListener('DOMContentLoaded', function(){
    listarUsuarios();
});

async function registrar_usuario() {
    const frmRegistrar = document.getElementById('frm_registrar_user');
    let pass1 = document.getElementById("contrasena").value;
    let confirm = document.getElementById("confirmarContrasena").value;

    if(pass1 !== confirm){
        Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'las contraseñas no coinciden',
                confirmButtonClass: 'btn btn-confirm mt-2',
                timer: 1000,
                showConfirmButton: false
            });
            return;
    }
    try {
        const datos = new FormData(frm_registrar_user);
        datos.append('sesion', session_session); 
        datos.append('token', token_token); 
        const respuesta = await fetching('registrar', datos);
        const json = await respuesta.json();
        if (json.status) {
            frmRegistrar.reset();
            let modalEl = document.getElementById("modalNuevoUsuario");
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
            listarUsuarios();
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

async function listarUsuarios() {
try {
    let dates = new FormData();
    dates.append('sesion', session_session); 
    dates.append('token', token_token); 
    const respuesta = await fetching('listarUsuarios', dates);
    const json = await respuesta.json();
    let tbody = document.getElementById("tbody_users");
    if(json.status){
            tbody.innerHTML= '';
            let datos = json.contenido;
            let cont = 0;
            datos.forEach(item => {
                let nuevaFila =  document.createElement("tr");
                nuevaFila.id = "fila" +item.id_usuario;
                cont ++;
                nuevaFila.innerHTML = `
                <td class="fw-bold">${cont}</td>
                <td>${item.nombre}</td>
                <td>${item.apellido}</td>
                <td>${item.usuario}</td>
                <td>${item.rol}</td>
                <td>${item.telefono}</td>
                <td>${item.estado}</td>
                <td>${item.fecha_registro}</td>

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

async function listarUsuario(id){
    let data = document.getElementById("data");
    let nombre = document.getElementById("nombre-n");
    let apellido = document.getElementById("apellido-n");
    let usuario = document.getElementById("usuario-n");
    let telefono = document.getElementById("telefono-n");
    let rol = document.getElementById("rol-n");
    let estado = document.getElementById("estado-n");
    try {
    let informacion = new FormData();
    informacion.append('sesion', session_session); 
    informacion.append('token', token_token); 
    informacion.append('id',id);
    const respuesta = await fetching('obtenerUsuario', informacion);
    const json = await respuesta.json();
    if(json.status){
    let datos = json.contenido;
       data.value = id;
       nombre.value = datos.nombre;
       apellido.value = datos.apellido;
       usuario.value = datos.usuario;
       telefono.value = datos.telefono;
       rol.value = datos.rol;
       estado.value = datos.activo;
    }else{
     console.log(json.mensaje);
    }
    } catch (e) {
        console.log('error function ||' + e);
    }
}
async function actualizarUser() {
    const form = document.getElementById('frm_act_user');
    try {
        const datos = new FormData(frm_act_user);
        datos.append('sesion', session_session); 
        datos.append('token', token_token); 
        const respuesta = await fetching('actualizar', datos);
        const json = await respuesta.json();
        if (json.status) {
            form.reset();
            let modalEl = document.getElementById("modalEditarUsuario");
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
            listarUsuarios();
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

