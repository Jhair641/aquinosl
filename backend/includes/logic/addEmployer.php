<?php
    include '../../config/db.php';
    
    // Verificar si el formulario fue enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recibir datos del formulario
        $dni = $_POST['dni'];
        $nombre = $_POST['nombre'];
        $pApellido = $_POST['p-apellido'];
        $sApellido = $_POST['s-apellido'];
        $carnet = $_POST['carnet'];
        $adr = $_POST['adr'];
        $cap = $_POST['cap'];
        $citaMedico = $_POST['cita-medico'];

        // Guardar los datos en la base de datos
        $empleado = R::dispense('empleados'); // La tabla se llama 'empleados'
        $empleado->dni = $dni;
        $empleado->nombre = $nombre;
        $empleado->primer_apellido = $pApellido;
        $empleado->segundo_apellido = $sApellido;
        $empleado->carnet = $carnet;
        $empleado->adr = $adr;
        $empleado->cap = $cap;
        $empleado->revision_medica = $citaMedico;
        R::store($empleado);

        // Redirigir de vuelta al formulario o a otra página
        header("Location: ../../index.php");
        exit();
    }


?>
<div>
    add employer
</div>