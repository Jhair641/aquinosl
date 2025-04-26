import axios from 'axios';

const apiUrl = 'http://localhost:3001/vehiculos/';

export const obtenerVehiculos = async () => {
  const respuesta = await axios.get(apiUrl);
  return respuesta.data;
};

export const crearVehiculo = async (vehiculo) => {
  const respuesta = await axios.post(apiUrl, vehiculo);
  return respuesta.data;
};

export const actualizarVehiculo = async (id, vehiculo) => {
  const respuesta = await axios.put(`${apiUrl}${id}`, vehiculo);
  return respuesta.data;
};

export const eliminarVehiculo = async (id) => {
  await axios.delete(`${apiUrl}${id}`);
};
