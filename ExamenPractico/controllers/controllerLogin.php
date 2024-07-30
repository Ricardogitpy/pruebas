<?php
require_once '../models/User.php';

header('Content-Type: application/json');

$response = array('success' => false, 'message' => 'Error desconocido');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User();
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];

    $loginResponse = $user->login();

    if ($loginResponse['success']) {
        session_start();
        $_SESSION['user_id'] = $loginResponse['idUsuario'];
        $_SESSION['email'] = $user->email;
        $response['success'] = true;
        $response['message'] = 'Login exitoso';
    } else {
        $response['message'] = $loginResponse['message'];
    }
}

echo json_encode($response);
?>
