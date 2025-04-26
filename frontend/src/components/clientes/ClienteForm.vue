<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
  visible: Boolean,
  cliente: Object,
  modo: String, // 'crear' o 'editar'
});

const emits = defineEmits(['close', 'guardar']);

const clienteForm = ref({ ...props.cliente });
const errores = ref({}); // Almacenar errores de validación

// Observar cambios en el cliente seleccionado
watch(
  () => props.cliente,
  (nuevoCliente) => {
    clienteForm.value = { ...nuevoCliente };
  }
);

// Función para validar el formulario
const validarFormulario = () => {
  const nuevosErrores = {};

  // Validar campos obligatorios
  const requiredFields = ['cif', 'nombre', 'direccion_almacen', 'direccion_fiscal'];
  requiredFields.forEach(field => {
    if (!clienteForm.value[field]) {
      nuevosErrores[field] = `El campo ${field} es obligatorio.`;
    }
  });

  // Validar formato del CIF (letra + 7 u 8 dígitos)
  if (clienteForm.value.cif && !/^[A-Za-z]\d{7,8}$/.test(clienteForm.value.cif)) {
    nuevosErrores.cif = "Formato de CIF inválido: debe ser una letra seguida de 7 u 8 dígitos.";
  }

  // Validar valores permitidos para forma_pago y forma_carga
  const formasPagoPermitidas = ['plazos', 'total'];
  if (clienteForm.value.forma_pago && !formasPagoPermitidas.includes(clienteForm.value.forma_pago)) {
    nuevosErrores.forma_pago = "Forma de pago no válida. Las opciones son: plazos, total.";
  }

  const formasCargaPermitidas = ['trasera', 'superior', 'lateral'];
  if (clienteForm.value.forma_carga && !formasCargaPermitidas.includes(clienteForm.value.forma_carga)) {
    nuevosErrores.forma_carga = "Forma de carga no válida. Las opciones son: trasera, superior, lateral.";
  }

  return nuevosErrores;
};

// Función para guardar los datos
const guardar = () => {
  errores.value = validarFormulario(); // Validar el formulario
  if (Object.keys(errores.value).length === 0) {
    emits('guardar', { ...clienteForm.value }); // Emitir evento si no hay errores
  }
};

// Cerrar modal y limpiar errores
const cerrarModal = () => {
  errores.value = {};
  emits('close');
};
</script>

<template>
  <CModal 
    alignment="center"
    scrollable
    :visible="visible"
    @close="cerrarModal"
    aria-labelledby="ClienteModal"
  >
    <CModalHeader>
      <CModalTitle id="ClienteModal">
        {{ modo === 'crear' ? 'Agregar cliente' : 'Editar cliente' }}
      </CModalTitle>
    </CModalHeader>
    <CModalBody>
      <CForm @submit.prevent="guardar" class="row g-3 needs-validation">
        <CCol>
          <!-- Campo CIF -->
          <div class="mb-3">
            <CFormInput id="cif" name="cif" label="CIF" v-model="clienteForm.cif"/>
            <span v-if="errores.cif" class="text-danger">{{ errores.cif }}</span>
          </div>

          <!-- Campo Nombre -->
          <div class="mb-3">
            <CFormInput id="nombre" name="nombre" label="Nombre" v-model="clienteForm.nombre"/>
            <span v-if="errores.nombre" class="text-danger">{{ errores.nombre }}</span>
          </div>

          <!-- Campo Dirección Almacén -->
          <div class="mb-3">
            <CFormInput id="direccion_almacen" name="direccion_almacen" label="Dirección Almacén" v-model="clienteForm.direccion_almacen"/>
            <span v-if="errores.direccion_almacen" class="text-danger">{{ errores.direccion_almacen }}</span>
          </div>

          <!-- Campo Dirección Fiscal -->
          <div class="mb-3">
            <CFormInput id="direccion_fiscal" name="direccion_fiscal" label="Dirección Fiscal" v-model="clienteForm.direccion_fiscal"/>
            <span v-if="errores.direccion_fiscal" class="text-danger">{{ errores.direccion_fiscal }}</span>
          </div>

          <!-- Campo Forma de Pago -->
          <div class="mb-3">
            <label for="forma_pago">Forma de Pago</label>
            <CFormSelect id="forma_pago" name="forma_pago" v-model="clienteForm.forma_pago">
              <option value="plazos">Plazos</option>
              <option value="total">Total</option>
            </CFormSelect>
            <span v-if="errores.forma_pago" class="text-danger">{{ errores.forma_pago }}</span>
          </div>

          <!-- Campo Forma de Carga -->
          <div class="mb-3">
            <label for="forma_carga">Forma de Carga</label>
            <CFormSelect id="forma_carga" name="forma_carga" v-model="clienteForm.forma_carga">
              <option value="trasera">Trasera</option>
              <option value="superior">Superior</option>
              <option value="lateral">Lateral</option>
            </CFormSelect>
            <span v-if="errores.forma_carga" class="text-danger">{{ errores.forma_carga }}</span>
          </div>
        </CCol>
        <CModalFooter>
          <CButton color="secondary" @click="cerrarModal">Cerrar</CButton>
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