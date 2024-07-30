<?php
require_once '../models/User.php';

header('Content-Type: application/json');

$response = array('success' => false, 'message' => 'Error desconocido');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = new User();
    $user->nombreCompleto = $_POST['nombreCompleto'];
    $user->email = $_POST['email'];
    $user->password = $_POST['password'];

    $registerResponse = $user->register();

    if ($registerResponse['success']) {
        $response['success'] = true;
        $response['message'] = 'Registro exitoso';
    } else {
        $response['message'] = $registerResponse['message'];
    }
}

echo json_encode($response);
?>
