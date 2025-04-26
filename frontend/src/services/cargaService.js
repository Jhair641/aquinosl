import axios from 'axios';

const apiUrl = 'http://localhost:3001/cargas/';
const apiUrlCif = 'http://localhost:3001/clientes/cif/';

export const obtenerCargas = async () => {
    const respuesta = await axios.get(apiUrl);
    return respuesta.data;
};

export const crearCarga = async (carga) => {
    const respuesta = await axios.post(apiUrl, carga);
    return respuesta.data;
};

export const actualizarCarga = async (id, carga) => {
    const respuesta = await axios.put(`${apiUrl}${id}`, carga);
    return respuesta.data;
};

export const eliminarCarga = async (id) => {
    await axios.delete(`${apiUrl}${id}`);
};

export const verificarCifCliente = async (cif) => {
    const respuesta = await axios.get(`${apiUrlCif}${cif}`);
    return respuesta.data.existe;
};
  
