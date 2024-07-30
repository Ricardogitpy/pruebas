<div class="container">
    <h2 class="text-center my-4">Gestión de Documentos</h2>

    <!-- Formulario para agregar o editar documentos -->
    <div id="formContainer">
        <form id="documentoForm">
            <input type="hidden" id="idDocumento" name="idDocumento">
            <div class="form-group">
                <label for="tipoDeDocumento">Tipo de Documento</label>
                <select class="form-control" id="tipoDeDocumento" name="tipoDeDocumento">
                    <option value="original">Original</option>
                    <option value="copia">Copia</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nombreDocumento">Nombre del Documento</label>
                <input type="text" class="form-control" id="nombreDocumento" name="nombreDocumento">
            </div>
            <div class="form-group">
                <label for="estadoDocumento">Estado del Documento</label>
                <select class="form-control" id="estadoDocumento" name="estadoDocumento">
                    <option value="creado">Creado</option>
                    <option value="aprobado">Aprobado</option>
                    <option value="rechazado">Rechazado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tramiteAsociado">Trámite Asociado</label>
                <select class="form-control" id="tramiteAsociado" name="tramiteAsociado">
                    <!-- Las opciones se llenarán mediante AJAX -->
                </select>
            </div>
            <button type="submit" class="btn btn-primary" id="submitButton">Agregar Documento</button>
            <button type="button" class="btn btn-secondary" id="cancelButton" style="display: none;">Cancelar</button>
        </form>
    </div>

    <!-- Tabla para listar documentos -->
    <div id="tableContainer" class="mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tipo</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Trámite Asociado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="documentosTableBody">
                <!-- Los datos se llenarán mediante AJAX -->
            </tbody>
        </table>
    </div>
</div>