const API_RESERVAS = "/api/reservas/";

async function getReservas() {
  const res = await fetch(API_RESERVAS);
  const data = await res.json();
  console.log("Listado de reservas:", data);
  return data;
}

async function createReservas(data) {
  const res = await fetch(API_RESERVAS, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data)
  });
  const result = await res.json();
  console.log("Reservas creado:", result);
  return result;
}

async function updateReservas(id, data) {
  const res = await fetch(API_RESERVAS + id, {
    method: "PUT",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data)
  });
  const result = await res.json();
  console.log("Reservas actualizado:", result);
  return result;
}

async function deleteReservas(id) {
  const res = await fetch(API_RESERVAS + id, { method: "DELETE" });
  const result = await res.json();
  console.log("Reservas eliminado:", result);
  return result;
}
