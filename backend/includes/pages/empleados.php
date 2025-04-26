<?php
    include('../../config/db.php');
    // Obtener los empleados
    $empleados = R::findAll('empleados');
?>

<div class="container-fluid p-0">

<h1 class="h3 mb-3"><strong>Empleados</strong></h1>

<div class="row mb-3">
    <!-- Button trigger modal -->
    <div class="col-sm-8 col-md-7 col-xl-5 col-xxl-3 d-flex">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClientModal">
            <i class="align-middle me-2" data-feather="plus-circle" style="height: 20px; width: 25px;"></i>
            <strong>Agregar Empleado</strong>
        </button>
    </div>
<!-- MODALS -->
    <!-- Start Add Client Modal -->
    <div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="clienteModalLabel">Agregar Empleado</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/includes/logic/addEmployer.php">
                    <div class="mb-3">
                        <label class="form-label">DNI</label>
                        <input class="form-control form-control-lg" type="number" name="dni" placeholder="Introduce el DNI" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input class="form-control form-control-lg" type="text" name="nombre" placeholder="Introduce el nombre" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Primer apellido</label>
                        <input class="form-control form-control-lg" type="text" name="p-apellido" placeholder="Introduce el primer apellido" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">segundo apellido</label>
                        <input class="form-control form-control-lg" type="text" name="s-apellido" placeholder="Introduce el segundo apellido" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Carnet</label>
                        <input class="form-control form-control-lg" type="date" name="carnet" placeholder="Introduce la proxima renovacion" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">ADR</label>
                        <input class="form-control form-control-lg" type="date" name="adr" placeholder="Introduce la proxima renovacion" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">CAP</label>
                        <input class="form-control form-control-lg" type="date" name="cap" placeholder="Introduce la proxima renovacion" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Revision médica</label>
                        <input class="form-control form-control-lg" type="date" name="cita-medico" placeholder="Introduce la proxima cita" />
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Agregar Empleado</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
    </div>
    <!-- End Add Client Modal -->
    <!-- Start Edit Client Modal -->
    <div class="modal fade" id="editClientModal" tabindex="-1" aria-labelledby="editClienteModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="editClienteModalLabel">Editar Cliente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                            <div class="mb-3">
                                <label class="form-label">CIF</label>
                                <input class="form-control form-control-lg" type="number" name="cif" placeholder="Introduce el CIF" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input class="form-control form-control-lg" type="text" name="nombre" placeholder="Introduce el nombre" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Horario</label>
                                <input class="form-control form-control-lg" type="text" name="horario" placeholder="Apartado aparte" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Direccion de almacen</label>
                                <input class="form-control form-control-lg" type="text" name="d-almacen" placeholder="Introduce la direcciòn" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Direccion fiscal</label>
                                <input class="form-control form-control-lg" type="text" name="d-fiscal" placeholder="Introduce la direcciòn" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contacto</label>
                                <input class="form-control form-control-lg" type="text" name="contacto" placeholder="Apartado aparte" />
                            </div>
                        </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success">Agregar Cliente</button>
            </div>
            </div>
        </div>
    </div>
    <!-- End Edit Client Modal -->
    <!-- Start Delete Client Modal -->
    <div class="modal fade" id="deleteClientModal" tabindex="-1" aria-labelledby="deleteClientModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteClientModalLabel">Editar Cliente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                            <div class="mb-3">
                                <label class="form-label">CIF</label>
                                <input class="form-control form-control-lg" type="number" name="cif" placeholder="Introduce el CIF" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Nombre</label>
                                <input class="form-control form-control-lg" type="text" name="nombre" placeholder="Introduce el nombre" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Horario</label>
                                <input class="form-control form-control-lg" type="text" name="horario" placeholder="Apartado aparte" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Direccion de almacen</label>
                                <input class="form-control form-control-lg" type="text" name="d-almacen" placeholder="Introduce la direcciòn" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Direccion fiscal</label>
                                <input class="form-control form-control-lg" type="text" name="d-fiscal" placeholder="Introduce la direcciòn" />
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contacto</label>
                                <input class="form-control form-control-lg" type="text" name="contacto" placeholder="Apartado aparte" />
                            </div>
                        </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success">Agregar Cliente</button>
            </div>
            </div>
        </div>
    </div>
    <!-- End Delete Client Modal -->
</div>
<div class="row">
    <div class="col-lg-12 col-xxl-12 d-flex" style="height: 600px;">
        <div class="card flex-fill">
            <div class="card-header">

                <h5 class="card-title mb-0">Lista de Empleados</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>DNI</th>
                            <th class="d-none d-xl-table-cell">Nombre</th>
                            <th class="d-none d-xl-table-cell">Apellidos</th>
                            <th class="d-none d-xl-table-cell">Carnet</th>
                            <th class="d-none d-xl-table-cell">ADR</th>
                            <th class="d-none d-xl-table-cell">CAP</th>
                            <th class="d-none d-md-table-cell">Cita medica</th>
                            <th>Acción</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($empleados as $empleado): ?>
                            <tr>
                                <td><?= htmlspecialchars($empleado->id) ?></td>
                                <td class="d-none d-xl-table-cell"><?= htmlspecialchars($empleado->nombre) ?></td>
                                <td class="d-none d-xl-table-cell"><?= htmlspecialchars($empleado->primer_apellido .' '.$empleado->segundo_apellido) ?></td>
                                <td class="d-none d-xl-table-cell"><?= htmlspecialchars($empleado->carnet) ?></td>
                                <td class="d-none d-xl-table-cell"><?= htmlspecialchars($empleado->adr) ?></td>
                                <td class="d-none d-xl-table-cell"><?= htmlspecialchars($empleado->cap) ?></td>
                                <td class="d-none d-xl-table-cell"><?= htmlspecialchars($empleado->revision_medica) ?></td>
                                <td>
                                    <a data-bs-toggle="modal" data-bs-target="#editClientModal">
                                        <i class="text-warning align-middle me-2" data-feather="edit"></i>
                                    </a>
                                    <a data-bs-toggle="modal" data-bs-target="#deleteClientModal">
                                        <i class="text-danger align-middle me-2" data-feather="delete"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($empleados)): ?>
                            <tr><td colspan="8">No hay empleados registrados</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>