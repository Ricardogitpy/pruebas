<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: /login');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            flex-direction: row;
        }
        .sidebar {
            height: 100%;
            width: 250px;
            background-color: #f8f9fa;
            padding: 20px;
            position: fixed;
        }
        .content {
            margin-left: 250px;
            padding: 20px;
            flex: 1;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Menú</h2>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" data-target="gestionarTramites.php" href="#">Gestión de Trámites</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-target="gestionarDocumentos.php" href="#">Gestión de Documentos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-target="publicaciones.html" href="#">Publicaciones</a>
            </li>
        </ul>
    </div>
    <div class="content">
        <h1>Bienvenido al Dashboard</h1>
        <p>Contenido solo visible para usuarios autenticados.</p>
        <a href="/pruebas/ExamenPractico/views/login.php" class="btn btn-danger">Cerrar sesión</a>
    </div>

    <!-- Incluye Bootstrap JS y dependencias -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('.nav-link').on('click', function(event) {
                event.preventDefault(); // Evita el comportamiento predeterminado del enlace
                
                var targetFile = $(this).data('target'); // Obtiene el archivo a cargar
                
                $.ajax({
                    url: targetFile,
                    method: 'GET',
                    success: function(response) {
                        $('.content').html(response); // Actualiza el contenido del div
                    },
                    error: function() {
                        $('.content').html('<p>Error al cargar el contenido.</p>');
                    }
                });
            });

            function fetchTramites() {
                $.ajax({
                    url: '/pruebas/ExamenPractico/controllers/TramitesController.php?action=read',
                    type: 'GET',
                    success: function(response) {
                        var data = JSON.parse(response);
                        var tableBody = $('#tramitesTableBody');
                        tableBody.empty();

                        $.each(data, function(index, tramite) {
                            var row = `<tr>
                                <td>${tramite.IdTramite}</td>
                                <td>${tramite.tipoTramite}</td>
                                <td>${tramite.observaciones}</td>
                                <td>${tramite.estadoTramite}</td>
                                <td>${tramite.fechaInicio}</td>
                                <td>${tramite.fechaFin}</td>
                                <td>${tramite.idUsuario}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm" onclick="editTramite(${tramite.IdTramite})">Editar</button>
                                    <button class="btn btn-danger btn-sm" onclick="deleteTramite(${tramite.IdTramite})">Eliminar</button>
                                </td>
                            </tr>`;
                            tableBody.append(row);
                        });
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error(textStatus, errorThrown);
                    }
                });
            }

            fetchTramites();

            $('#showFormButton').on('click', function(e) {
                e.preventDefault();
                $('#formContainer').show();
                $('#tableContainer').hide();
                $('#submitButton').text('Agregar Trámite');
                $('#IdTramite').val('');
                $('#cancelButton').show();
            });

            $('#cancelButton').on('click', function() {
                $('#formContainer').hide();
                $('#tableContainer').show();
                $('#cancelButton').hide();
            });

            $('#tramiteForm').on('submit', function(e) {
                e.preventDefault();
                var idTramite = $('#IdTramite').val();
                var url = idTramite ? '/pruebas/ExamenPractico/controllers/TramitesController.php?action=update' : '/pruebas/ExamenPractico/controllers/TramitesController.php?action=create';
                
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        var result = JSON.parse(response);
                        if (result.success) {
                            alert('Operación exitosa');
                            $('#formContainer').hide();
                            $('#tableContainer').show();
                            fetchTramites();
                        } else {
                            alert('Error: ' + result.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error(textStatus, errorThrown);
                    }
                });
            });

            window.editTramite = function(id) {
                $.ajax({
                    url: '/pruebas/ExamenPractico/controllers/TramitesController.php?action=readOne&IdTramite=' + id,
                    type: 'GET',
                    success: function(response) {
                        var tramite = JSON.parse(response);
                        $('#IdTramite').val(tramite.IdTramite);
                        $('#tipoTramite').val(tramite.tipoTramite);
                        $('#observaciones').val(tramite.observaciones);
                        $('#estadoTramite').val(tramite.estadoTramite);
                        $('#fechaInicio').val(tramite.fechaInicio);
                        $('#fechaFin').val(tramite.fechaFin);
                        $('#idUsuario').val(tramite.idUsuario);
                        $('#formContainer').show();
                        $('#tableContainer').hide();
                        $('#submitButton').text('Actualizar Trámite');
                        $('#cancelButton').show();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error(textStatus, errorThrown);
                    }
                });
            }

            window.deleteTramite = function(id) {
                if (confirm('¿Estás seguro de que quieres eliminar este trámite?')) {
                    $.ajax({
                        url: '/pruebas/ExamenPractico/controllers/TramitesController.php?action=delete',
                        type: 'POST',
                        data: { IdTramite: id },
                        success: function(response) {
                            var result = JSON.parse(response);
                            if (result.success) {
                                alert('Trámite eliminado');
                                fetchTramites();
                            } else {
                                alert('Error: ' + result.message);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            console.error(textStatus, errorThrown);
                        }
                    });
                }
            }
        });
    </script>
</body>
</html>
