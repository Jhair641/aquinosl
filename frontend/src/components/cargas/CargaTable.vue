<script setup>
import { cilPen, cilTrash, cibDiscover } from '@coreui/icons';
import { computed } from 'vue'; // Importa la función computed

const props = defineProps({
  cargas: Array,
});

const emits = defineEmits(['editar', 'eliminar', 'estado']);

const cargasFiltradas = computed(() => {
  return props.cargas.filter(carga => carga.estado == 1);
});
</script>

<template>
  <div class="table-responsive mt-3">
    <CTable striped hover>
      <CTableHead>
        <CTableRow>
          <CTableHeaderCell>CIF Cliente</CTableHeaderCell>
          <CTableHeaderCell>Tipo de viaje</CTableHeaderCell>
          <CTableHeaderCell>Mercancía</CTableHeaderCell>
          <CTableHeaderCell>Peso</CTableHeaderCell>
          <CTableHeaderCell>Medida</CTableHeaderCell>
          <CTableHeaderCell>Precio</CTableHeaderCell>
          <CTableHeaderCell>Dirección de carga</CTableHeaderCell>
          <CTableHeaderCell>Dirección de descarga</CTableHeaderCell>
          <CTableHeaderCell>Fecha de carga</CTableHeaderCell>
          <CTableHeaderCell>Fecha de descarga</CTableHeaderCell>
          <CTableHeaderCell>Vehículo asignado</CTableHeaderCell>
          <CTableHeaderCell>Acción</CTableHeaderCell>
        </CTableRow>
      </CTableHead>
      <CTableBody>
        <CTableRow v-for="carga in cargasFiltradas" :key="carga.id">
            <CTableDataCell>{{ carga.cif_cliente }}</CTableDataCell>
            <CTableDataCell>{{ carga.tipo_viaje }}</CTableDataCell>
            <CTableDataCell>{{ carga.mercancia }}</CTableDataCell>
            <CTableDataCell>{{ carga.peso }}</CTableDataCell>
            <CTableDataCell>{{ carga.medida }}</CTableDataCell>
            <CTableDataCell>{{ carga.precio }}</CTableDataCell>
            <CTableDataCell>{{ carga.direccion_carga }}</CTableDataCell>
            <CTableDataCell>{{ carga.direccion_descarga }}</CTableDataCell>
            <CTableDataCell>{{ carga.fecha_carga }}</CTableDataCell>
            <CTableDataCell>{{ carga.fecha_descarga }}</CTableDataCell>
            <CTableDataCell>{{ carga.vehiculo_asignado }}</CTableDataCell>
            <CTableDataCell class="d-flex gap-1">
                <CButton @click="$emit('editar', carga)" color="primary">
                <CIcon :icon="cilPen" />
                </CButton>
                <CButton @click="$emit('eliminar', carga.id)" color="danger">
                <CIcon :icon="cilTrash" />
                </CButton>
                <CButton @click="$emit('estado', carga.id)" color="warning">
                    Finalizar
                </CButton>
            </CTableDataCell>
        </CTableRow>
      </CTableBody>
    </CTable>
  </div>
</template>