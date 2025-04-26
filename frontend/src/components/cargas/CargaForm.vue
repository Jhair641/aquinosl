<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
    visible: Boolean,
    carga: Object,
    modo: String,
    cifcheck: Function,
});

const emits = defineEmits(['close', 'guardar']);

const cargaForm = ref({ ...props.carga });
const errors = ref({});
const existe = ref(null);
const formato = ref(null);

watch(
    () => props.carga,
    (nuevaCarga) => {
        cargaForm.value = { ...nuevaCarga };
        existe.value = null;
        formato.value = null;
    }
);

const onBlur = async () => {
    const cif = cargaForm.value.cif_cliente?.trim();
    
    // Validación de formato CIF
    if (!/^[A-Za-z]\d{7,8}$/.test(cif)) {
        errors.value.cif_cliente = "Formato de CIF inválido (1 letra mayúscula + 7 u 8 números)";
        formato.value = false;
        existe.value = null;
        return;
    }
    
    formato.value = true;
    errors.value.cif_cliente = null;
    
    // Verificar existencia del CIF
    existe.value = await props.cifcheck(cif);
    if (!existe.value) {
        errors.value.cif_cliente = "El CIF no existe en el sistema";
    }
};

const validarCampos = () => {
    errors.value = {};
    let isValid = true;

    // Campos obligatorios
    const requiredFields = [
        'cif_cliente', 'mercancia', 'peso', 
        'medida', 'precio', 'direccion_carga', 'direccion_descarga',
        'fecha_carga', 'fecha_descarga'
    ];

    requiredFields.forEach(field => {
        if (!cargaForm.value[field]) {
            errors.value[field] = "Este campo es obligatorio";
            isValid = false;
        }
    });

    // Validaciones numéricas
    if (cargaForm.value.peso <= 0) {
        errors.value.peso = "El peso debe ser mayor a 0";
        isValid = false;
    }

    if (cargaForm.value.medida <= 0) {
        errors.value.medida = "La medida debe ser mayor a 0";
        isValid = false;
    }

    if (cargaForm.value.precio <= 0) {
        errors.value.precio = "El precio debe ser mayor a 0";
        isValid = false;
    }

    // Validación de fechas
    if (new Date(cargaForm.value.fecha_descarga) <= new Date(cargaForm.value.fecha_carga)) {
        errors.value.fecha_descarga = "La fecha de descarga debe ser posterior a la de carga";
        isValid = false;
    }

    return isValid;
};

const guardar = () => {
    if (!validarCampos()) return;
    if (!formato.value || !existe.value) {
        errors.value.cif_cliente = "Verifique el CIF antes de guardar";
        return;
    }
    
    emits('guardar', { ...cargaForm.value });
};
</script>

<template>
  <CModal 
    alignment="center"
    scrollable
    :visible="visible"
    @close="$emit('close')"
    aria-labelledby="CargasModal"
  >
    <CModalHeader>
      <CModalTitle id="CargasModal">
        {{ modo === 'crear' ? 'Agregar carga' : 'Editar carga' }}
      </CModalTitle>
    </CModalHeader>
    <CModalBody>
      <CForm @submit.prevent="guardar" class="row g-3 needs-validation">
        <CCol>
          <!-- CIF Cliente -->
          <div class="mb-3">
            <CFormInput 
              id="cif_cliente" 
              name="cif_cliente" 
              label="CIF Cliente" 
              @blur="onBlur" 
              v-model="cargaForm.cif_cliente"  
            />
            <div v-if="errors.cif_cliente" class="text-danger small mt-1">
              {{ errors.cif_cliente }}
            </div>
          </div>

          <!-- Tipo de Viaje -->
          <div class="mb-3">
            <CFormSelect 
              id="tipo_viaje" 
              name="tipo_viaje" 
              label="Tipo de viaje" 
              v-model="cargaForm.tipo_viaje" 
              :options="['trailer_completo', 'rigido_completo', 'grupajes']"  
            />
            <div v-if="errors.tipo_viaje" class="text-danger small mt-1">
              {{ errors.tipo_viaje }}
            </div>
          </div>

          <div class="mb-3">
            <CFormInput
              id="mercancia" 
              name="mercancia" 
              label="Mercancía" 
              v-model="cargaForm.mercancia"
            />
            <div v-if="errors.mercancia" class="text-danger small mt-1">
              {{ errors.mercancia }}
            </div>
          </div>
          <div class="mb-3">
            <CFormInput 
              id="direccion_carga" 
              name="direccion_carga" 
              label="Dirección de carga" 
              v-model="cargaForm.direccion_carga"
            />
            <div v-if="errors.direccion_carga" class="text-danger small mt-1">
              {{ errors.direccion_carga }}
            </div>
          </div>
          <div class="mb-3">
            <CFormInput 
              id="direccion_descarga" 
              name="direccion_descarga" 
              label="Dirección de descarga" 
              v-model="cargaForm.direccion_descarga"  
            />
            <div v-if="errors.direccion_descarga" class="text-danger small mt-1">
              {{ errors.direccion_descarga }}
            </div>
          </div>

          <!-- Campos numéricos -->
          <div class="mb-3">
            <CFormInput 
              id="peso" 
              name="peso" 
              label="Peso (kg)" 
              type="number" 
              min="0.01" 
              step="0.01" 
              v-model="cargaForm.peso"  
            />
            <div v-if="errors.peso" class="text-danger small mt-1">
              {{ errors.peso }}
            </div>
          </div>

          <div class="mb-3">
            <CFormInput 
              id="medida" 
              name="medida" 
              label="Medida (m³)" 
              type="number" 
              min="0.01" 
              step="0.01" 
              v-model="cargaForm.medida"  
            />
            <div v-if="errors.medida" class="text-danger small mt-1">
              {{ errors.medida }}
            </div>
          </div>

          <div class="mb-3">
            <CFormInput 
              id="precio" 
              name="precio" 
              label="Precio (€)" 
              type="number" 
              min="0.01" 
              step="0.01" 
              v-model="cargaForm.precio"  
            />
            <div v-if="errors.precio" class="text-danger small mt-1">
              {{ errors.precio }}
            </div>
          </div>

          <!-- Fechas -->
          <div class="mb-3">
            <label for="fecha_carga" class="form-label">Fecha de carga</label>
            <input 
              type="date" 
              id="fecha_carga" 
              class="form-control" 
              v-model="cargaForm.fecha_carga"  
            />
            <div v-if="errors.fecha_carga" class="text-danger small mt-1">
              {{ errors.fecha_carga }}
            </div>
          </div>

          <div class="mb-3">
            <label for="fecha_descarga" class="form-label">Fecha de descarga</label>
            <input 
              type="date" 
              id="fecha_descarga" 
              class="form-control" 
              v-model="cargaForm.fecha_descarga"  
            />
            <div v-if="errors.fecha_descarga" class="text-danger small mt-1">
              {{ errors.fecha_descarga }}
            </div>
          </div>

          <!-- Resto de campos -->
          <div class="mb-3">
            <CFormInput 
              id="vehiculo_asignado" 
              name="vehiculo_asignado" 
              label="Vehículo asignado" 
              v-model="cargaForm.vehiculo_asignado"  
            />
            <div v-if="errors.vehiculo_asignado" class="text-danger small mt-1">
              {{ errors.vehiculo_asignado }}
            </div>
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

<style scoped>
.text-danger {
  font-size: 0.875em;
  margin-top: 0.25rem;
}
</style>