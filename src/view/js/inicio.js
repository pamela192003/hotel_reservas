document.addEventListener('DOMContentLoaded',function(){
    listarReservas();
});

async function listarReservas() {
try {
    let dates = new FormData();
    dates.append('sesion', session_session); 
    dates.append('token', token_token); 
    const respuesta = await fetch(base_url_server+'src/control/Reservas.php?tipo=listarReservas',{
        method: 'POST',
        mode: 'cors',
        cache:'no-cache',
        body: dates
    });
    const json = await respuesta.json();
    let cuerpo = document.getElementById("tbody-reservas");
    if(json.status){
            cuerpo.innerHTML= '';
            let datos = json.contenido;
            let total = document.getElementById("totalReservas");
            total.innerHTML = datos.length;
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
                `;
                
                cuerpo.appendChild(nuevaFila);
        });
    }else{
        console.log(json.mensaje);
    }
} catch (e) {
    console.log('erro function  || ' + e); 
} 
}