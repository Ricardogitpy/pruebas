<?php
require_once '../models/Tramite.php';

class TramitesController {
    public function read() {
        $tramite = new Tramite();
        $stmt = $tramite->read();
        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }
        echo json_encode($data);
    }

    public function create() {
        $tramite = new Tramite();
        $tramite->tipoTramite = $_POST['tipoTramite'];
        $tramite->observaciones = $_POST['observaciones'];
        $tramite->estadoTramite = $_POST['estadoTramite'];
        $tramite->fechaInicio = $_POST['fechaInicio'];
        $tramite->fechaFin = $_POST['fechaFin'];
        $tramite->idUsuario = $_POST['idUsuario'];

        if ($tramite->create()) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Error al crear'));
        }
    }

    public function readOne() {
        $tramite = new Tramite();
        $tramite->IdTramite = $_GET['IdTramite'];
        $tramite->readOne();
        echo json_encode($tramite);
    }

    public function update() {
        $tramite = new Tramite();
        $tramite->IdTramite = $_POST['IdTramite'];
        $tramite->tipoTramite = $_POST['tipoTramite'];
        $tramite->observaciones = $_POST['observaciones'];
        $tramite->estadoTramite = $_POST['estadoTramite'];
        $tramite->fechaInicio = $_POST['fechaInicio'];
        $tramite->fechaFin = $_POST['fechaFin'];
        $tramite->idUsuario = $_POST['idUsuario'];

        if ($tramite->update()) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Error al actualizar'));
        }
    }

    public function delete() {
        $tramite = new Tramite();
        $tramite->IdTramite = $_POST['IdTramite'];
        if ($tramite->delete()) {
            echo json_encode(array('success' => true));
        } else {
            echo json_encode(array('success' => false, 'message' => 'Error al eliminar'));
        }
    }
}
?>
