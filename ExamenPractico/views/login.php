<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Inicio de Sesión</title>
    <!-- Incluye Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center">Iniciar Sesión</h2>
                <form id="loginForm">
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Ingresa tu correo electrónico">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Ingresa tu contraseña">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Iniciar Sesión</button>
                    <button type="button" class="btn btn-secondary btn-block">Registrarse</button>
                </form>
            </div>
        </div>
    </div>

        <!-- Incluye Bootstrap JS y dependencias -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.7/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                var email = $('#email').val();
                var password = $('#password').val();
                
                $.ajax({
                    url: '/pruebas/ExamenPractico/controllers/controllerLogin.php',
                    type: 'POST',
                    data: { email: email, password: password },
                    success: function(response) {
                        // Aquí puedes manejar la respuesta del servidor
                        console.log(response);
                        if (response.success) {
                            alert('Login exitoso');
                            // Redirecciona a la página del dashboard
                            window.location.href = '/pruebas/ExamenPractico/views/dashboard.php';
                        } else {
                            alert('Error: ' + response.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error(textStatus, errorThrown);
                    }
                });
            });
            $('button.btn-secondary').on('click', function() {
                window.location.href = '/pruebas/ExamenPractico/views/register.php';
            });
        });
    </script>
</body>
</html>