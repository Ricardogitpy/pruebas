<?php
require_once 'Database.php';

class Tramite {
    private $conn;
    private $table = 'tramites';

    public $IdTramite;
    public $tipoTramite;
    public $observaciones;
    public $estadoTramite;
    public $fechaInicio;
    public $fechaFin;
    public $idUsuario;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Leer todos los trámites
    public function read() {
        $query = 'SELECT * FROM ' . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Crear un nuevo trámite
    public function create() {
        $query = 'INSERT INTO ' . $this->table . ' SET tipoTramite = :tipoTramite, observaciones = :observaciones, estadoTramite = :estadoTramite, fechaInicio = :fechaInicio, fechaFin = :fechaFin, idUsuario = :idUsuario';
        $stmt = $this->conn->prepare($query);

        // Limpiar datos
        $this->tipoTramite = htmlspecialchars(strip_tags($this->tipoTramite));
        $this->observaciones = htmlspecialchars(strip_tags($this->observaciones));
        $this->estadoTramite = htmlspecialchars(strip_tags($this->estadoTramite));
        $this->fechaInicio = htmlspecialchars(strip_tags($this->fechaInicio));
        $this->fechaFin = htmlspecialchars(strip_tags($this->fechaFin));
        $this->idUsuario = htmlspecialchars(strip_tags($this->idUsuario));

        // Enlazar datos
        $stmt->bindParam(':tipoTramite', $this->tipoTramite);
        $stmt->bindParam(':observaciones', $this->observaciones);
        $stmt->bindParam(':estadoTramite', $this->estadoTramite);
        $stmt->bindParam(':fechaInicio', $this->fechaInicio);
        $stmt->bindParam(':fechaFin', $this->fechaFin);
        $stmt->bindParam(':idUsuario', $this->idUsuario);

        return $stmt->execute();
    }

    // Leer un trámite por ID
    public function readOne() {
        $query = 'SELECT * FROM ' . $this->table . ' WHERE IdTramite = :IdTramite LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':IdTramite', $this->IdTramite);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        // Establecer propiedades del trámite
        $this->tipoTramite = $row['tipoTramite'];
        $this->observaciones = $row['observaciones'];
        $this->estadoTramite = $row['estadoTramite'];
        $this->fechaInicio = $row['fechaInicio'];
        $this->fechaFin = $row['fechaFin'];
        $this->idUsuario = $row['idUsuario'];
    }

    // Actualizar un trámite
    public function update() {
        $query = 'UPDATE ' . $this->table . ' SET tipoTramite = :tipoTramite, observaciones = :observaciones, estadoTramite = :estadoTramite, fechaInicio = :fechaInicio, fechaFin = :fechaFin, idUsuario = :idUsuario WHERE IdTramite = :IdTramite';
        $stmt = $this->conn->prepare($query);

        // Limpiar datos
        $this->tipoTramite = htmlspecialchars(strip_tags($this->tipoTramite));
        $this->observaciones = htmlspecialchars(strip_tags($this->observaciones));
        $this->estadoTramite = htmlspecialchars(strip_tags($this->estadoTramite));
        $this->fechaInicio = htmlspecialchars(strip_tags($this->fechaInicio));
        $this->fechaFin = htmlspecialchars(strip_tags($this->fechaFin));
        $this->idUsuario = htmlspecialchars(strip_tags($this->idUsuario));
        $this->IdTramite = htmlspecialchars(strip_tags($this->IdTramite));

        // Enlazar datos
        $stmt->bindParam(':tipoTramite', $this->tipoTramite);
        $stmt->bindParam(':observaciones', $this->observaciones);
        $stmt->bindParam(':estadoTramite', $this->estadoTramite);
        $stmt->bindParam(':fechaInicio', $this->fechaInicio);
        $stmt->bindParam(':fechaFin', $this->fechaFin);
        $stmt->bindParam(':idUsuario', $this->idUsuario);
        $stmt->bindParam(':IdTramite', $this->IdTramite);

        return $stmt->execute();
    }

    // Eliminar un trámite
    public function delete() {
        $query = 'DELETE FROM ' . $this->table . ' WHERE IdTramite = :IdTramite';
        $stmt = $this->conn->prepare($query);
        $this->IdTramite = htmlspecialchars(strip_tags($this->IdTramite));
        $stmt->bindParam(':IdTramite', $this->IdTramite);
        return $stmt->execute();
    }
}
?>
