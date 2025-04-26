<template>
    <div>
        <CButton @click="abrirModal('crear')" color="primary">Nueva Carga</CButton>

        <CargaTable
        :cargas="cargas"
        @editar="abrirModal('editar', $event)"
        @eliminar="eliminarCargaHandler"
        @estado="confirmarFacturacion"
        />

        <CargaForm
        :visible="modalVisible"
        :carga="cargaSeleccionada"
        :modo="modoModal"
        :cifcheck="validarCifCliente"
        @close="modalVisible = false"
        @guardar="guardarCarga"
        />
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Swal from 'sweetalert2';
import { obtenerCargas, crearCarga, actualizarCarga, eliminarCarga, verificarCifCliente } from '@/services/cargaService';
import CargaForm from '@/components/cargas/CargaForm.vue';
import CargaTable from '@/components/cargas/CargaTable.vue';

const cargas = ref([]);

const modalVisible = ref(false);
const modoModal = ref('crear'); // 'crear' o 'editar'
const cargaSeleccionada = ref({});

const abrirModal = (modo, carga = {}) => {
    modoModal.value = modo;
    cargaSeleccionada.value = carga;
    modalVisible.value = true;
};

const cargarCargas = async () => {
    cargas.value = await obtenerCargas();
};

const guardarCarga = async (carga) => {
    try {
        if (modoModal.value === 'crear') {
        await crearCarga(carga);
        Swal.fire('Éxito', 'Carga creada correctamente', 'success');
        } else {
        const respuesta = await actualizarCarga(carga.id, carga);
        Swal.fire('Éxito', `${respuesta.message}`, 'success');
        }
        modalVisible.value = false;
        cargarCargas();
    } catch (error) {
        Swal.fire('Error', 'No se pudo guardar la carga', 'error');
    }
};

const eliminarCargaHandler = async (id) => {
    const confirmacion = await Swal.fire({
        title: '¿Estás seguro?',
        text: 'No podrás deshacer esta acción',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
    });

    if (confirmacion.isConfirmed) {
        try {
        await eliminarCarga(id);
        Swal.fire('Éxito', 'Carga eliminada', 'success');
        cargarCargas();
        } catch (error) {
        Swal.fire('Error', 'No se pudo eliminar la carga', 'error');
        }
    }
};

// Nueva función para validar el CIF del cliente
const validarCifCliente = async (cif) => {
    const respuesta = await verificarCifCliente(cif);
    return respuesta;
};

const confirmarFacturacion = async (id) => {
    const confirmacion = await Swal.fire({
        title: '¿Finalizar carga?',
        text: 'Esta acción cambiará el estado de la carga a finalizada.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, finalizar',
        cancelButtonText: 'Cancelar',
    });

    if (confirmacion.isConfirmed) {
        await facturarCarga(id);
    }
};

const facturarCarga = async (id) => {
  const cargaActualizada = {
    estado: 0 // Cambia el estado a 1 para indicar que está facturada/finalizada
  };

  try {
    const respuesta = await actualizarCarga(id, cargaActualizada);
    Swal.fire('Éxito', 'Carga finalizada correctamente', 'success');
    cargarCargas(); // Recarga la tabla después de la actualización
    console.log('Carga actualizada correctamente', respuesta);
  } catch (error) {
    Swal.fire('Error', 'No se pudo finalizar la carga', 'error');
    console.error('Error al actualizar la carga', error);
  }
};

onMounted(cargarCargas);
</script>