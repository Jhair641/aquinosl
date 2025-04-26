<script setup>
import { cilPen, cilTrash } from '@coreui/icons';

const props = defineProps({
  vehiculos: Array,
});

const emits = defineEmits(['editar', 'eliminar']);
</script>

<template>
  <div class="table-responsive mt-3">
    <CTable striped hover>
      <CTableHead>
        <CTableRow>
          <CTableHeaderCell>Matricula</CTableHeaderCell>
          <CTableHeaderCell>Tipo</CTableHeaderCell>
          <CTableHeaderCell>ITV</CTableHeaderCell>
          <CTableHeaderCell>Seguro</CTableHeaderCell>
          <CTableHeaderCell>Tacógrafo</CTableHeaderCell>
          <CTableHeaderCell>Acción</CTableHeaderCell>
        </CTableRow>
      </CTableHead>
      <CTableBody>
        <CTableRow v-for="vehiculo in vehiculos" :key="vehiculo.id">
          <CTableDataCell>{{ vehiculo.matricula }}</CTableDataCell>
          <CTableDataCell>{{ vehiculo.tipo }}</CTableDataCell>
          <CTableDataCell>{{ vehiculo.itv }}</CTableDataCell>
          <CTableDataCell>{{ vehiculo.seguro }}</CTableDataCell>
          <CTableDataCell>{{ vehiculo.tacografo }}</CTableDataCell>
          <CTableDataCell class="d-flex gap-2">
            <CButton @click="$emit('editar', vehiculo)" color="primary">
              <CIcon :icon="cilPen" />
            </CButton>
            <CButton @click="$emit('eliminar', vehiculo.id)" color="danger">
              <CIcon :icon="cilTrash" />
            </CButton>
          </CTableDataCell>
        </CTableRow>
      </CTableBody>
    </CTable>
  </div>
</template>
