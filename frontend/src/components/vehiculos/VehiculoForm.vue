<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
  visible: Boolean,
  vehiculo: Object,
  modo: String, // 'crear' o 'editar'
});

const emits = defineEmits(['close', 'guardar']);

const vehiculoForm = ref({ ...props.vehiculo });

watch(
  () => props.vehiculo,
  (nuevoVehiculo) => {
    vehiculoForm.value = { ...nuevoVehiculo };
  }
);

const guardar = () => {
  emits('guardar', { ...vehiculoForm.value });
};
</script>

<template>
  <CModal 
    alignment="center"
    scrollable
    :visible="visible"
    @close="$emit('close')"
    aria-labelledby="VehiculoModal"
  >
    <CModalHeader>
      <CModalTitle id="VehiculoModal">
        {{ modo === 'crear' ? 'Agregar vehículo' : 'Editar vehículo' }}
      </CModalTitle>
    </CModalHeader>
    <CModalBody>
      <CForm @submit.prevent="guardar" class="row g-3 needs-validation">
        <CCol>
          <div class="mb-3">
            <CFormInput id="matricula" name="matricula" label="Matrícula" v-model="vehiculoForm.matricula" required />
          </div>
          <div class="mb-3">
            <CFormSelect id="tipo" label="Tipo" v-model="vehiculoForm.tipo" :options="['tractora', 'semiremolque', 'rigido',]" />
          </div>
          <div class="mb-3">
            <CFormInput id="itv" name="itv" label="ITV" type="date" v-model="vehiculoForm.itv" />
          </div>
          <div class="mb-3">
            <CFormInput id="seguro" name="seguro" label="Seguro" type="date" v-model="vehiculoForm.seguro" />
          </div>
          <div class="mb-3">
            <CFormInput id="tacografo" name="tacografo" label="Tacógrafo" type="date" v-model="vehiculoForm.tacografo" />
          </div>
        </CCol>
        <CModalFooter>
          <CButton color="secondary" @click="$emit('close')">Cerrar</CButton>
          <CButton color="primary" type="submit">
            {{ modo === 'crear' ? 'Agregar' : 'Actualizar' }}
          </CButton>
        </CModalFooter>
      </CForm>
    </CModalBody>
  </CModal>
</template>
