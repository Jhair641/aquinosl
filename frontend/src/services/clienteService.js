import axios from 'axios';

const apiUrl = 'http://localhost:3001/clientes/';

export const obtenerClientes = async () => {
  const respuesta = await axios.get(apiUrl);
  return respuesta.data;
};

export const crearCliente = async (cliente) => {
  const respuesta = await axios.post(apiUrl, cliente);
  return respuesta.data;
};

export const actualizarCliente = async (id, cliente) => {
  const respuesta = await axios.put(`${apiUrl}${id}`, cliente);
  return respuesta.data;
};

export const eliminarCliente = async (id) => {
  await axios.delete(`${apiUrl}${id}`);
};
