const API_CLIENTES = "/api/clientes/";

async function getClientes() {
  const res = await fetch(API_CLIENTES);
  const data = await res.json();
  console.log("Listado de clientes:", data);
  return data;
}

async function createClientes(data) {
  const res = await fetch(API_CLIENTES, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data)
  });
  const result = await res.json();
  console.log("Clientes creado:", result);
  return result;
}

async function updateClientes(id, data) {
  const res = await fetch(API_CLIENTES + id, {
    method: "PUT",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data)
  });
  const result = await res.json();
  console.log("Clientes actualizado:", result);
  return result;
}

async function deleteClientes(id) {
  const res = await fetch(API_CLIENTES + id, { method: "DELETE" });
  const result = await res.json();
  console.log("Clientes eliminado:", result);
  return result;
}
