<script setup>
import { cilPen, cilTrash } from '@coreui/icons';

const props = defineProps({
  clientes: Array,
});

const emits = defineEmits(['editar', 'eliminar']);
</script>

<template>
  <div class="table-responsive mt-3">
    <CTable striped hover>
      <CTableHead>
        <CTableRow>
          <CTableHeaderCell>CIF</CTableHeaderCell>
          <CTableHeaderCell>Nombre</CTableHeaderCell>
          <CTableHeaderCell>Dirección Almacén</CTableHeaderCell>
          <CTableHeaderCell>Dirección Fiscal</CTableHeaderCell>
          <CTableHeaderCell>Forma de Pago</CTableHeaderCell>
          <CTableHeaderCell>Forma de Carga</CTableHeaderCell>
          <CTableHeaderCell>Acción</CTableHeaderCell>
        </CTableRow>
      </CTableHead>
      <CTableBody>
        <CTableRow v-for="cliente in clientes" :key="cliente.id">
          <CTableDataCell>{{ cliente.cif }}</CTableDataCell>
          <CTableDataCell>{{ cliente.nombre }}</CTableDataCell>
          <CTableDataCell>{{ cliente.direccion_almacen }}</CTableDataCell>
          <CTableDataCell>{{ cliente.direccion_fiscal }}</CTableDataCell>
          <CTableDataCell>{{ cliente.forma_pago }}</CTableDataCell>
          <CTableDataCell>{{ cliente.forma_carga }}</CTableDataCell>
          <CTableDataCell class="d-flex gap-2">
            <CButton @click="$emit('editar', cliente)" color="primary">
              <CIcon :icon="cilPen" />
            </CButton>
            <CButton @click="$emit('eliminar', cliente.id)" color="danger">
              <CIcon :icon="cilTrash" />
            </CButton>
          </CTableDataCell>
        </CTableRow>
      </CTableBody>
    </CTable>
  </div>
</template>
