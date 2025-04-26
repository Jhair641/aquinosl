<script setup>
import { ref, computed } from 'vue';

const props = defineProps({
  cargas: Array,
});

const emit = defineEmits(['facturarSeleccionadas']);

const cargasFiltradas = computed(() => {
  return props.cargas.filter(carga => carga.estado == 0);
});

const cargasSeleccionadas = ref([]);

const toggleSeleccion = (id) => {
  const index = cargasSeleccionadas.value.indexOf(id);
  if (index > -1) {
    cargasSeleccionadas.value.splice(index, 1);
  } else {
    cargasSeleccionadas.value.push(id);
  }
};

const seleccionarTodo = (event) => {
  if (event.target.checked) {
    cargasSeleccionadas.value = cargasFiltradas.value.map(carga => carga.id);
  } else {
    cargasSeleccionadas.value = [];
  }
};

const emitirFacturarSeleccionadas = () => {
  if (cargasSeleccionadas.value.length > 0) {
    emit('facturarSeleccionadas', cargasSeleccionadas.value);
  } else {
    alert('Por favor, selecciona al menos una carga para facturar.');
  }
};
</script>

<template>
  <div class="table-responsive mt-3">
    <div class="mb-3">
      <CButton color="primary" @click="emitirFacturarSeleccionadas">Facturar Seleccionadas</CButton>
    </div>
    <CTable striped hover>
      <CTableHead>
        <CTableRow>
          <CTableHeaderCell>
            <CFormCheck @change="seleccionarTodo" />
          </CTableHeaderCell>
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
        </CTableRow>
      </CTableHead>
      <CTableBody>
        <CTableRow v-for="carga in cargasFiltradas" :key="carga.id">
          <CTableDataCell>
            <CFormCheck
              :id="`carga-${carga.id}`"
              :value="carga.id"
              :checked="cargasSeleccionadas.includes(carga.id)"
              @change="toggleSeleccion(carga.id)"
            />
          </CTableDataCell>
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
        </CTableRow>
      </CTableBody>
    </CTable>
  </div>
</template>