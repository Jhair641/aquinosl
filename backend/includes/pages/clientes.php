<div class="container-fluid p-0">

<h1 class="h3 mb-3"><strong>Clientes</strong></h1>

<div class="row mb-3">
    <!-- Button trigger modal -->
    <div class="col-sm-8 col-md-7 col-xl-5 col-xxl-3 d-flex">
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addClientModal">
            <i class="align-middle me-2" data-feather="plus-circle" style="height: 20px; width: 25px;"></i>
            <strong>Agregar Cliente</strong>
        </button>
    </div>
<!-- MODALS -->
    <!-- Start Add Client Modal -->
    <div class="modal fade" id="addClientModal" tabindex="-1" aria-labelledby="addClientModalLabel">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="clienteModalLabel">Agregar Cliente</h1>
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
                <h1 class="modal-title fs-5" id="deleteClientModalLabel">Eliminar Cliente</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">CIF</label>
                        <input class="form-control form-control-lg" type="number" name="cif" placeholder="Introduce el CIF" />
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
    <div class="col-lg-12 col-xxl-9 d-flex" style="height: 600px;">
        <div class="card flex-fill">
            <div class="card-header">

                <h5 class="card-title mb-0">Lista de Clientes</h5>
            </div>
            <div class="table-responsive">
                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th class="d-none d-xl-table-cell">Start Date</th>
                            <th class="d-none d-xl-table-cell">End Date</th>
                            <th>Accion</th>
                            <th class="d-none d-md-table-cell">Assignee</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Project Apollo</td>
                            <td class="d-none d-xl-table-cell">01/01/2023</td>
                            <td class="d-none d-xl-table-cell">31/06/2023</td>
                            <td>
                                <a data-bs-toggle="modal" data-bs-target="#editClientModal">
                                    <i class="text-warning align-middle me-2" data-feather="edit"></i>
                                </a>
                                <a data-bs-toggle="modal" data-bs-target="#deleteClientModal">
                                    <i class="text-danger align-middle me-2" data-feather="delete"></i>
                                </a>
                            </td>
                            <td class="d-none d-md-table-cell">Vanessa Tucker</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>