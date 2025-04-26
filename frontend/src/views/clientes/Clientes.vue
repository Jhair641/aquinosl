<template>
  <div>
    <CButton @click="abrirModal('crear')" color="primary">Nuevo Cliente</CButton>
    
    <ClienteTable :clientes="clientes" @editar="abrirModal('editar', $event)" @eliminar="eliminarClienteHandler" />

    <ClienteForm 
      :visible="modalVisible"
      :cliente="clienteSeleccionado"
      :modo="modoModal"
      @close="modalVisible = false"
      @guardar="guardarCliente"
    />
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Swal from 'sweetalert2';
import { obtenerClientes, crearCliente, actualizarCliente, eliminarCliente } from '@/services/clienteService';
import ClienteForm from '@/components/clientes/ClienteForm.vue';
import ClienteTable from '@/components/clientes/ClienteTable.vue';

const clientes = ref([]);
const modalVisible = ref(false);
const modoModal = ref('crear'); // 'crear' o 'editar'
const clienteSeleccionado = ref({});

const abrirModal = (modo, cliente = {}) => {
  modoModal.value = modo;
  clienteSeleccionado.value = cliente;
  modalVisible.value = true;
};

const cargarClientes = async () => {
  clientes.value = await obtenerClientes();
};

const guardarCliente = async (cliente) => {
  try {
    if (modoModal.value === 'crear') {
      await crearCliente(cliente);
      Swal.fire('Éxito', 'Cliente creado correctamente', 'success');
    } else {
      await actualizarCliente(cliente.id, cliente);
      Swal.fire('Éxito', 'Cliente actualizado correctamente', 'success');
    }
    modalVisible.value = false;
    cargarClientes();
  } catch (error) {
    Swal.fire('Error', 'No se pudo guardar el cliente', 'error');
  }
};

const eliminarClienteHandler = async (id) => {
  const confirmacion = await Swal.fire({
    title: '¿Estás seguro?',
    text: 'No podrás deshacer esta acción',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: 'Sí, eliminar',
    cancelButtonText: 'Cancelar',
  });

  if (confirmacion.isConfirmed) {
    await eliminarCliente(id);
    Swal.fire('Éxito', 'Cliente eliminado', 'success');
    cargarClientes();
  }
};

onMounted(cargarClientes);
</script>
