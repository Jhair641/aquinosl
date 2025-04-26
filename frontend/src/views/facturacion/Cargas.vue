<template>
    <div>
        <CargaTable
        :cargas="cargas"
        @facturarSeleccionadas="generarFacturaPDF"
        />
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Swal from 'sweetalert2';
import { obtenerCargas, actualizarCarga } from '@/services/cargaService'; // Importa actualizarCarga si planeas cambiar el estado
import CargaTable from '@/components/facturacion/CargaTable.vue';
import { jsPDF } from 'jspdf'; // Importa jsPDF

const cargas = ref([]);

const cargarCargas = async () => {
    cargas.value = await obtenerCargas();
};

const generarFacturaPDF = async (idsCargas) => {
    if (idsCargas.length === 0) {
        Swal.fire('Advertencia', 'No se ha seleccionado ninguna carga para facturar.', 'warning');
        return;
    }

    const cargasParaFacturar = cargas.value.filter(carga => idsCargas.includes(carga.id));

    if (cargasParaFacturar.length > 0) {
        const pdf = new jsPDF();
        pdf.text('Factura de Cargas - Aquino SL', 10, 10);
        let y = 20;

        cargasParaFacturar.forEach(carga => {
            pdf.text(`CIF Cliente: ${carga.cif_cliente}`, 10, y);
            y += 10;
            pdf.text(`Tipo de Viaje: ${carga.tipo_viaje}`, 10, y);
            y += 10;
            pdf.text(`Mercancía: ${carga.mercancia}`, 10, y);
            y += 10;
            pdf.text(`Precio: ${carga.precio}`, 10, y);
            y += 15; // Espacio entre cargas
        });

        pdf.save('factura_cargas.pdf');

        // Opcional: Actualizar el estado de las cargas a facturado (estado = 1)
        for (const carga of cargasParaFacturar) {
            try {
                await actualizarCarga(carga.id, { estado: 1 });
            } catch (error) {
                console.error('Error al actualizar el estado de la carga:', error);
                Swal.fire('Error', `No se pudo actualizar el estado de la carga con ID ${carga.id}`, 'error');
            }
        }
        Swal.fire('Éxito', 'Factura generada correctamente.', 'success');
        cargarCargas(); // Recargar la tabla para ver los cambios de estado (si los aplicaste)
    } else {
        Swal.fire('Error', 'No se encontraron las cargas seleccionadas.', 'error');
    }
};

onMounted(cargarCargas);
</script>