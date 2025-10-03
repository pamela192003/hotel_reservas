const API_PAGOS = "/api/pagos/";

async function getPagos() {
  const res = await fetch(API_PAGOS);
  const data = await res.json();
  console.log("Listado de pagos:", data);
  return data;
}

async function createPagos(data) {
  const res = await fetch(API_PAGOS, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data)
  });
  const result = await res.json();
  console.log("Pagos creado:", result);
  return result;
}

async function updatePagos(id, data) {
  const res = await fetch(API_PAGOS + id, {
    method: "PUT",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data)
  });
  const result = await res.json();
  console.log("Pagos actualizado:", result);
  return result;
}

async function deletePagos(id) {
  const res = await fetch(API_PAGOS + id, { method: "DELETE" });
  const result = await res.json();
  console.log("Pagos eliminado:", result);
  return result;
}
