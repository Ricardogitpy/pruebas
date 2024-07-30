<div class="container">
        <h2 class="text-center my-4">Gestión de Trámites</h2>
        
        <!-- Formulario para agregar o editar trámites -->
        <div id="formContainer">
            <form id="tramiteForm">
                <input type="hidden" id="IdTramite" name="IdTramite">
                <div class="form-group">
                    <label for="tipoTramite">Tipo de Trámite</label>
                    <select class="form-control" id="tipoTramite" name="tipoTramite">
                        <option value="presencial">Presencial</option>
                        <option value="en_linea">En línea</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="observaciones">Observaciones</label>
                    <input type="text" class="form-control" id="observaciones" name="observaciones">
                </div>
                <div class="form-group">
                    <label for="estadoTramite">Estado del Trámite</label>
                    <select class="form-control" id="estadoTramite" name="estadoTramite">
                        <option value="Creado">Creado</option>
                        <option value="En proceso">En proceso</option>
                        <option value="Autorizado">Autorizado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="fechaInicio">Fecha de Inicio</label>
                    <input type="date" class="form-control" id="fechaInicio" name="fechaInicio">
                </div>
                <div class="form-group">
                    <label for="fechaFin">Fecha de Fin</label>
                    <input type="date" class="form-control" id="fechaFin" name="fechaFin">
                </div>
                <div class="form-group">
                    <label for="idUsuario">ID de Usuario</label>
                    <input type="number" class="form-control" id="idUsuario" name="idUsuario">
                </div>
                <button type="submit" class="btn btn-primary" id="submitButton">Agregar Trámite</button>
                <button type="button" class="btn btn-secondary" id="cancelButton" style="display: none;">Cancelar</button>
            </form>
        </div>

        <!-- Tabla para listar trámites -->
        <div id="tableContainer" class="mt-4">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Observaciones</th>
                        <th>Estado</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Usuario</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tramitesTableBody">
                    <!-- Los datos se llenarán mediante AJAX -->
                </tbody>
            </table>
        </div>
    </div>