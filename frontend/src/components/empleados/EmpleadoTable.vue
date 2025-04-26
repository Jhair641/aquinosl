<script setup>
import { cilPen, cilTrash } from '@coreui/icons';
import { onMounted } from 'vue';
import { useToast } from 'vue-toastification';

const props = defineProps({
  empleados: Array,
});

const emits = defineEmits(['editar', 'eliminar']);

const toast = useToast();

const verificarVencimientos = () => {
  const hoy = new Date();
  const unMesEnMilisegundos = 30 * 24 * 60 * 60 * 1000;
  const unaSemanaEnMilisegundos = 7 * 24 * 60 * 60 * 1000;

  props.empleados.forEach(empleado => {
    const verificarFecha = (fechaVencimiento, tipo) => {
      if (fechaVencimiento) {
        const fechaVencimientoDate = new Date(fechaVencimiento);
        const diferencia = fechaVencimientoDate.getTime() - hoy.getTime();

        if (diferencia > 0 && diferencia <= unMesEnMilisegundos) {
          toast.warning(`El ${tipo} de ${empleado.nombre} vence el ${fechaVencimientoDate.toLocaleDateString()}.`);
        } else if (diferencia > 0 && diferencia <= unaSemanaEnMilisegundos) {
          toast.info(`El ${tipo} de ${empleado.nombre} vence pronto (${fechaVencimientoDate.toLocaleDateString()}).`);
        } else if (diferencia < 0 && Math.abs(diferencia) <= unaSemanaEnMilisegundos) {
          toast.error(`El ${tipo} de ${empleado.nombre} venció recientemente el ${fechaVencimientoDate.toLocaleDateString()}.`);
        } else if (diferencia < 0) {
          toast.error(`El ${tipo} de ${empleado.nombre} venció el ${fechaVencimientoDate.toLocaleDateString()}.`);
        }
      }
    };

    verificarFecha(empleado.carnet, 'carnet de conducir');
    verificarFecha(empleado.adr, 'ADR');
    verificarFecha(empleado.cap, 'CAP');
    verificarFecha(empleado.revision_medica, 'revisión médica');
  });
};

onMounted(() => {
  verificarVencimientos();
  // Opcional: Verificar los vencimientos periódicamente
    setInterval(verificarVencimientos, 100000); // Verificar cada hora
});
</script>

<template>
  <div class="table-responsive mt-3">
    <CTable striped hover>
      <CTableHead>
        <CTableRow>
          <CTableHeaderCell>DNI</CTableHeaderCell>
          <CTableHeaderCell>Nombre</CTableHeaderCell>
          <CTableHeaderCell>Primer apellido</CTableHeaderCell>
          <CTableHeaderCell>Segundo apellido</CTableHeaderCell>
          <CTableHeaderCell>Renovación carnet</CTableHeaderCell>
          <CTableHeaderCell>Renovación ADR</CTableHeaderCell>
          <CTableHeaderCell>Renovación CAP</CTableHeaderCell>
          <CTableHeaderCell>Revisión médica</CTableHeaderCell>
          <CTableHeaderCell>Acción</CTableHeaderCell>
        </CTableRow>
      </CTableHead>
      <CTableBody>
        <CTableRow v-for="empleado in empleados" :key="empleado.id">
          <CTableDataCell>{{ empleado.dni }}</CTableDataCell>
          <CTableDataCell>{{ empleado.nombre }}</CTableDataCell>
          <CTableDataCell>{{ empleado.primer_apellido }}</CTableDataCell>
          <CTableDataCell>{{ empleado.segundo_apellido }}</CTableDataCell>
          <CTableDataCell>{{ empleado.carnet }}</CTableDataCell>
          <CTableDataCell>{{ empleado.adr }}</CTableDataCell>
          <CTableDataCell>{{ empleado.cap }}</CTableDataCell>
          <CTableDataCell>{{ empleado.revision_medica }}</CTableDataCell>
          <CTableDataCell class="d-flex gap-2">
            <CButton @click="$emit('editar', empleado)" color="primary">
              <CIcon :icon="cilPen" />
            </CButton>
            <CButton @click="$emit('eliminar', empleado.id)" color="danger">
              <CIcon :icon="cilTrash" />
            </CButton>
          </CTableDataCell>
        </CTableRow>
      </CTableBody>
    </CTable>
  </div>
</template>