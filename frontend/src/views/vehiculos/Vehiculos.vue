<script setup>
import { ref, onMounted } from 'vue';
import Swal from 'sweetalert2';
import { obtenerVehiculos, crearVehiculo, actualizarVehiculo, eliminarVehiculo } from '@/services/vehiculoService';
import VehiculoForm from '@/components/vehiculos/VehiculoForm.vue';
import VehiculoTable from '@/components/vehiculos/VehiculoTable.vue';

const vehiculos = ref([]);
const modalVisible = ref(false);
const modoModal = ref('crear'); // 'crear' o 'editar'
const vehiculoSeleccionado = ref({});

const abrirModal = (modo, vehiculo = {}) => {
  modoModal.value = modo;
  vehiculoSeleccionado.value = vehiculo;
  modalVisible.value = true;
};

const cargarVehiculos = async () => {
  vehiculos.value = await obtenerVehiculos();
};

const guardarVehiculo = async (vehiculo) => {
  try {
    if (modoModal.value === 'crear') {
      await crearVehiculo(vehiculo);
      Swal.fire('Éxito', 'Vehículo creado correctamente', 'success');
    } else {
      await actualizarVehiculo(vehiculo.id, vehiculo);
      Swal.fire('Éxito', 'Vehículo actualizado correctamente', 'success');
    }
    modalVisible.value = false;
    cargarVehiculos();
  } catch (error) {
    Swal.fire('Error', 'No se pudo guardar el vehículo', 'error');
  }
};

const eliminarVehiculoHandler = async (id) => {
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
      await eliminarVehiculo(id);
      Swal.fire('Éxito', 'Vehículo eliminado', 'success');
      cargarVehiculos();
    } catch (error) {
      Swal.fire('Error', 'No se pudo eliminar el vehículo', 'error');
    }
  }
};

onMounted(cargarVehiculos);
</script>

<template>
  <div>
    <CButton @click="abrirModal('crear')" color="primary">Nuevo Vehículo</CButton>
    
    <VehiculoTable 
      :vehiculos="vehiculos" 
      @editar="abrirModal('editar', $event)" 
      @eliminar="eliminarVehiculoHandler" 
    />

    <VehiculoForm 
      :visible="modalVisible"
      :vehiculo="vehiculoSeleccionado"
      :modo="modoModal"
      @close="modalVisible = false"
      @guardar="guardarVehiculo"
    />
  </div>
</template>
