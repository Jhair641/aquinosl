<template>
  <div>
    <CButton @click="abrirModal('crear')" color="primary">Nuevo Empleado</CButton>
    
    <EmpleadoTable 
      :empleados="empleados" 
      @editar="abrirModal('editar', $event)" 
      @eliminar="eliminarEmpleadoHandler" 
    />

    <EmpleadoForm 
      :visible="modalVisible"
      :empleado="empleadoSeleccionado"
      :modo="modoModal"
      @close="modalVisible = false"
      @guardar="guardarEmpleado"
    />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Swal from 'sweetalert2';
import { obtenerEmpleados, crearEmpleado, actualizarEmpleado, eliminarEmpleado } from '@/services/empleadoService';
import EmpleadoForm from '@/components/empleados/EmpleadoForm.vue';
import EmpleadoTable from '@/components/empleados/EmpleadoTable.vue';
import '@/styles/empleados/empleados.css';

const empleados = ref([]);
const modalVisible = ref(false);
const modoModal = ref('crear'); // 'crear' o 'editar'
const empleadoSeleccionado = ref({});

const abrirModal = (modo, empleado = {}) => {
  modoModal.value = modo;
  empleadoSeleccionado.value = empleado;
  modalVisible.value = true;
};

const cargarEmpleados = async () => {
  empleados.value = await obtenerEmpleados();
};

const guardarEmpleado = async (empleado) => {
  try {
    if (modoModal.value === 'crear') {
      await crearEmpleado(empleado);
      Swal.fire('Éxito', 'Empleado creado correctamente', 'success');
    } else {
      await actualizarEmpleado(empleado.id, empleado);
      Swal.fire('Éxito', 'Empleado actualizado correctamente', 'success');
    }
    modalVisible.value = false;
    cargarEmpleados();
  } catch (error) {
    Swal.fire('Error', 'No se pudo guardar el empleado', 'error');
  }
};

const eliminarEmpleadoHandler = async (id) => {
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
      await eliminarEmpleado(id);
      Swal.fire('Éxito', 'Empleado eliminado', 'success');
      cargarEmpleados();
    } catch (error) {
      Swal.fire('Error', 'No se pudo eliminar el empleado', 'error');
    }
  }
};

onMounted(cargarEmpleados);
</script>
