async function fetching(tipo, datos) {
    const uri = base_url_server + 'src/control/Clients_api.php?tipo='+tipo;
    const response = await fetch(uri, { method: 'POST',mode: 'cors', cache: 'no-cache', body: datos});
    if (!response.ok) { throw new Error(`Error HTTP: ${response.status}`); }
    return response;
}
document.addEventListener('DOMContentLoaded', function(){
    listarClientesApi();
});

async function registrarCliente() {
    const frmRegistrar = document.getElementById('new_clienteApi');
    try {
        const datos = new FormData(new_clienteApi);
        datos.append('sesion', session_session); 
        datos.append('token', token_token); 
        const respuesta = await fetching('registrarCliente', datos);
        const json = await respuesta.json();
        if (json.status) {
            frmRegistrar.reset();
            let modalEl = document.getElementById("modalNuevoCliente");
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
            listarClientesApi();
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

async function listarClientesApi() {
try {
    let dates = new FormData();
    dates.append('sesion', session_session); 
    dates.append('token', token_token); 
    const respuesta = await fetching('listarClientesApi', dates);
    const json = await respuesta.json();
    let tbody = document.getElementById("tbody_clientsApi");
    if(json.status){
            tbody.innerHTML= '';
            let datos = json.contenido;
            let cont = 0;
            datos.forEach(item => {
                let nuevaFila =  document.createElement("tr");
                nuevaFila.id = "fila" +item.id;
                cont ++;
                nuevaFila.innerHTML = `
                <td class="fw-bold">${cont}</td>
                <td>${item.ruc}</td>
                <td>${item.razon_social}</td>
                <td>${item.telefono}</td>
                <td>${item.correo}</td>
                <td>${item.status}</td>
                <td><span class="badge bg-info text-dark">${item.countTokens} tokens</span></td>
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

async function listarCliente(id){
    let data = document.getElementById("data");
    let ruc = document.getElementById("ruc-n");
    let razon = document.getElementById("empresaCliente-n");
    let telefono = document.getElementById("telefonoCliente-n");
    let correo = document.getElementById("emailCliente-n");
    let estado = document.getElementById("estadoCliente-n");
    try {
    let informacion = new FormData();
    informacion.append('sesion', session_session); 
    informacion.append('token', token_token); 
    informacion.append('id',id);
    const respuesta = await fetching('obtenerCliente', informacion);
    const json = await respuesta.json();
    if(json.status){
    let datos = json.contenido;
       data.value = id;
       ruc.value = datos.ruc;
       razon.value = datos.razon_social;
       telefono.value = datos.telefono;
       correo.value = datos.correo;
       estado.value = datos.estado;
    }else{
     console.log(json.mensaje);
    }
    } catch (e) {
        console.log('error function ||' + e);
    }
}

async function actualizarCliente() {
    const form = document.getElementById('act_clienteApi');
    try {
        const datos = new FormData(act_clienteApi);
        datos.append('sesion', session_session); 
        datos.append('token', token_token); 
        const respuesta = await fetching('actualizarCliente', datos);
        const json = await respuesta.json();
        if (json.status) {
            form.reset();
            let modalEl = document.getElementById("modalEditarCliente");
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
            listarClientesApi();
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

function asignarValuesToken(id){
    let datatoken = document.getElementById("dataToken");
    datatoken.value = id;
    listarTokensCliente(id);
}
async function listarTokensCliente(id) {
    let bodyHtml = document.getElementById("tbody_tokens");
      bodyHtml.innerHTML = '';
        try {
        let datos = new FormData();
          datos.append('token', token_token);  
          datos.append('sesion', session_session); 
          datos.append('id', id); 
          const respuesta = await fetching('obtenerTokensCliente', datos);
          json = await respuesta.json();
        
          if(json.status){
            
            let datos = json.contenido;
            let cont = 0;
            datos.forEach((item) => {
                let nuevaFila = document.createElement("tr");
                nuevaFila.id = item.id;
                
                cont++;
                nuevaFila.innerHTML = `
                    <td>${cont}</td>
                    <td><span class="font-monospace">${item.token}</span></td>
                    <td>${item.estado}</td>
                    <td>${item.fecha_registro}</td>
                    <td class="text-center">${item.options}</td>
                `;    
                bodyHtml.appendChild(nuevaFila);
            });
            
          }else if(json.mensaje == "Error_Sesion"){
           alerta_sesion();
          }else{
          console.log(json.mensaje)
          }
        
    } catch (e) {
        console.log('erro function || '+ e);     
    }
}

function generarToken(){
    Swal.fire({
  title: "Generar Token?",
  text: "¿Deseas Generar token para este cliente?",
  icon: "warning",
  showCancelButton: true,
  confirmButtonColor: "#3085d6",
  cancelButtonColor: "#d33",
  confirmButtonText: "Si, generar token!"
}).then((result) => {
  if (result.isConfirmed) {
     generarTokenClient();
  }
});
}

async function generarTokenClient() {
    let dataClient = document.getElementById("dataToken").value;
    try {
          let datos = new FormData();
          datos.append('token', token_token);  
          datos.append('sesion', session_session); 
          datos.append('data', dataClient); 
          let respue = await fetching('generarTokenClient',datos);
          json = await respue.json();
          if(json.status){
                 Swal.fire({
                    title: "Token generado!",
                    text: json.mensaje,
                    icon: "success"
                    });
                    listarTokensCliente(dataClient);
          }else if(json.mensaje == "Error_Sesion"){
            alerta_sesion();
          }else{
                 Swal.fire({
                    title: "Error!",
                    text: json.mensaje,
                    icon: "error"
                    });
          }
     } catch (e) {
            console.log('error funct || ' + e);
     }
}

async function cambiarEstado(idtoken, estado){
     let dataClient = document.getElementById("dataToken").value;
    try {
        let datos = new FormData();
          datos.append('token', token_token);  
          datos.append('sesion', session_session); 
          datos.append('data', idtoken); 
          datos.append('status', estado); 
          let respue = await fetching('cambiarEstadoToken',datos);
          json = await respue.json();
          if(json.status){
              listarTokensCliente(dataClient);
          } else if(json.mensaje == "Error_Sesion"){
            alerta_sesion();
          }else{
                 Swal.fire({
                    title: "Error!",
                    text: json.mensaje,
                    icon: "error"
                    });
          }
        
    } catch (e) {
        console.log('error funct || ' + e);     
    }
}
