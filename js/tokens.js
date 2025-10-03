const API_TOKENS = "/api/tokens/";

async function getTokens() {
  const res = await fetch(API_TOKENS);
  const data = await res.json();
  console.log("Listado de tokens:", data);
  return data;
}

async function createTokens(data) {
  const res = await fetch(API_TOKENS, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data)
  });
  const result = await res.json();
  console.log("Tokens creado:", result);
  return result;
}

async function updateTokens(id, data) {
  const res = await fetch(API_TOKENS + id, {
    method: "PUT",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(data)
  });
  const result = await res.json();
  console.log("Tokens actualizado:", result);
  return result;
}

async function deleteTokens(id) {
  const res = await fetch(API_TOKENS + id, { method: "DELETE" });
  const result = await res.json();
  console.log("Tokens eliminado:", result);
  return result;
}
