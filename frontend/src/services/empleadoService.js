import axios from 'axios';

const apiUrl = 'http://localhost:3001/empleados/';

export const obtenerEmpleados = async () => {
  const respuesta = await axios.get(apiUrl);
  return respuesta.data;
};

export const crearEmpleado = async (empleado) => {
  const respuesta = await axios.post(apiUrl, empleado);
  return respuesta.data;
};

export const actualizarEmpleado = async (id, empleado) => {
  const respuesta = await axios.put(`${apiUrl}${id}`, empleado);
  return respuesta.data;
};

export const eliminarEmpleado = async (id) => {
  await axios.delete(`${apiUrl}${id}`);
};
