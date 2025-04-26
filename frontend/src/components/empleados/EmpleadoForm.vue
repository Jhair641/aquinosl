<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
  visible: Boolean,
  empleado: Object,
  modo: String,
});

const emits = defineEmits(['close', 'guardar']);

const empleadoForm = ref({ ...props.empleado });
const errores = ref({}); // Almacenar errores

// Observar cambios en el empleado seleccionado
watch(
  () => props.empleado,
  (nuevoEmpleado) => {
    empleadoForm.value = { ...nuevoEmpleado };
  }
);

// Función para validar campos
const validarFormulario = () => {
  const nuevosErrores = {};

  // Validar campos obligatorios
  const requiredFields = ['dni', 'nombre', 'primer_apellido', 'segundo_apellido', 'carnet', 'adr', 'cap', 'revision_medica'];
  requiredFields.forEach(field => {
    if (!empleadoForm.value[field]) {
      nuevosErrores[field] = `El campo ${field} es obligatorio.`;
    }
  });

  // Validar formato DNI (8 dígitos + letra mayúscula)
  if (empleadoForm.value.dni && !/^\d{8}[A-Z]$/.test(empleadoForm.value.dni.toUpperCase())) {
    nuevosErrores.dni = "Formato de DNI inválido (8 números + 1 letra mayúscula).";
  }

  // Validar fechas futuras
  const fechaActual = new Date();
  const camposFecha = ['carnet', 'adr', 'cap', 'revision_medica'];
  camposFecha.forEach(campo => {
    if (empleadoForm.value[campo]) {
      const fechaCampo = new Date(empleadoForm.value[campo]);
      if (fechaCampo < fechaActual) {
        nuevosErrores[campo] = `La fecha de ${campo} debe ser futura.`;
      }
    }
  });

  return nuevosErrores;
};

// Guardar datos
const guardar = () => {
  errores.value = validarFormulario();
  if (Object.keys(errores.value).length === 0) {
    emits('guardar', { ...empleadoForm.value });
  }
};

// Cerrar modal y limpiar errores
const cerrarModal = () => {
  errores.value = {};
  emits('close');
};
</script>

<template>
  <CModal :visible="visible" @close="cerrarModal">
    <CModalHeader>
      <CModalTitle id="EmpleadoModal">
        {{ modo === 'crear' ? 'Agregar empleado' : 'Editar empleado' }}
      </CModalTitle>
    </CModalHeader>
    <CModalBody>
      <CForm @submit.prevent="guardar">
        <!-- Campo DNI -->
        <div class="mb-3">
          <CFormInput id="dni" label="DNI" v-model="empleadoForm.dni" />
          <span v-if="errores.dni" class="text-danger">{{ errores.dni }}</span>
        </div>

        <!-- Campo Nombre -->
        <div class="mb-3">
          <CFormInput id="nombre" label="Nombre" v-model="empleadoForm.nombre" />
          <span v-if="errores.nombre" class="text-danger">{{ errores.nombre }}</span>
        </div>

        <!-- Repetir para otros campos con sus errores -->
        <div class="mb-3">
          <CFormInput id="primer_apellido" name="primer_apellido" label="Primer apellido" v-model="empleadoForm.primer_apellido"/>
          <span v-if="errores.primer_apellido" class="text-danger">{{ errores.primer_apellido }}</span>
        </div>

        <div class="mb-3">
          <CFormInput id="segundo_apellido" name="segundo_apellido" label="Segundo apellido" v-model="empleadoForm.segundo_apellido"/>
          <span v-if="errores.segundo_apellido" class="text-danger">{{ errores.segundo_apellido }}</span>
        </div>

        <div class="mb-3">
          <label for="carnet">Renovación de carnet</label>
          <input type="date" id="carnet" v-model="empleadoForm.carnet" />
          <span v-if="errores.carnet" class="text-danger">{{ errores.carnet }}</span>
        </div>

        <div class="mb-3">
          <label for="adr">Renovación de ADR</label>
          <input type="date" id="adr" v-model="empleadoForm.adr" />
          <span v-if="errores.adr" class="text-danger">{{ errores.adr }}</span>
        </div>

        <div class="mb-3">
          <label for="cap">Renovación de CAP</label>
          <input type="date" id="cap" v-model="empleadoForm.cap" />
          <span v-if="errores.cap" class="text-danger">{{ errores.cap }}</span>
        </div>
        <!-- Ejemplo para fechas -->
        <div class="mb-3">
          <label>Revisión médica</label>
          <input type="date" v-model="empleadoForm.revision_medica" />
          <span v-if="errores.revision_medica" class="text-danger">{{ errores.revision_medica }}</span>
        </div>
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

<style scoped>
.text-danger {
  color: red;
  font-size: 0.875em;
}
</style>
