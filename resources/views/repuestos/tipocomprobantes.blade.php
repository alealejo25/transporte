<!-- HTML con Bootstrap para las tablas tipocomprobantes, estadocomprobantes, etc. -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ABM de Tablas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>ABM de Tablas</h1>

        <!-- Tabla de Ejemplo: TipoComprobantes -->
        <h2>TipoComprobantes</h2>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTipoComprobante">Agregar Nuevo</button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="tipocomprobantesTable">
                <!-- Filas dinámicas cargadas con JavaScript -->
            </tbody>
        </table>

        <!-- Modal para Agregar/Editar TipoComprobante -->
        <div class="modal fade" id="modalTipoComprobante" tabindex="-1" aria-labelledby="modalTipoComprobanteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTipoComprobanteLabel">Agregar TipoComprobante</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formTipoComprobante">
                            <input type="hidden" id="tipoComprobanteId">
                            <div class="mb-3">
                                <label for="tipoComprobanteNombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="tipoComprobanteNombre" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Ejemplo: EstadoComprobantes -->
        <h2>EstadoComprobantes</h2>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalEstadoComprobante">Agregar Nuevo</button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="estadocomprobantesTable">
                <!-- Filas dinámicas cargadas con JavaScript -->
            </tbody>
        </table>

        <!-- Modal para Agregar/Editar EstadoComprobante -->
        <div class="modal fade" id="modalEstadoComprobante" tabindex="-1" aria-labelledby="modalEstadoComprobanteLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalEstadoComprobanteLabel">Agregar EstadoComprobante</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formEstadoComprobante">
                            <input type="hidden" id="estadoComprobanteId">
                            <div class="mb-3">
                                <label for="estadoComprobanteEstado" class="form-label">Estado</label>
                                <input type="text" class="form-control" id="estadoComprobanteEstado" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Ejemplo: TurnoPañol -->
        <h2>TurnoPañol</h2>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTurnoPañol">Agregar Nuevo</button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Turno</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="turnopañolTable">
                <!-- Filas dinámicas cargadas con JavaScript -->
            </tbody>
        </table>

        <!-- Modal para Agregar/Editar TurnoPañol -->
        <div class="modal fade" id="modalTurnoPañol" tabindex="-1" aria-labelledby="modalTurnoPañolLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalTurnoPañolLabel">Agregar TurnoPañol</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formTurnoPañol">
                            <input type="hidden" id="turnoPañolId">
                            <div class="mb-3">
                                <label for="turnoPañolTurno" class="form-label">Turno</label>
                                <input type="text" class="form-control" id="turnoPañolTurno" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Ejemplo: MarcaRepuestos -->
        <h2>MarcaRepuestos</h2>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalMarcaRepuestos">Agregar Nuevo</button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Marca</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="marcarepuestosTable">
                <!-- Filas dinámicas cargadas con JavaScript -->
            </tbody>
        </table>

        <!-- Modal para Agregar/Editar MarcaRepuestos -->
        <div class="modal fade" id="modalMarcaRepuestos" tabindex="-1" aria-labelledby="modalMarcaRepuestosLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalMarcaRepuestosLabel">Agregar MarcaRepuestos</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="formMarcaRepuestos">
                            <input type="hidden" id="marcaRepuestosId">
                            <div class="mb-3">
                                <label for="marcaRepuestosNombre" class="form-label">Marca</label>
                                <input type="text" class="form-control" id="marcaRepuestosNombre" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Ejemplo: Repuestos -->
        <h2>Repuestos</h2>
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalRepuestos">Agregar Nuevo</button>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Cantidad</th>
                    <th>Marca</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="repuestosTable">
                <!-- Filas dinámicas cargadas con JavaScript -->
            </tbody>
        </table>

        <!-- Modal para Agregar/Editar Repuestos -->
        <div class="modal