<?php
require_once 'database.php';

class User {
    private $conn;
    private $table = 'Usuario';

    public $idUsuario;
    public $email;
    public $password;
    public $nombreCompleto;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Método para iniciar sesión
    public function login() {
        // Construcción de la consulta
        $query = 'SELECT idUsuario, password FROM ' . $this->table . ' WHERE email = :email';
        
        // Preparar la consulta
        $stmt = $this->conn->prepare($query);
        
        // Sanear el valor del email
        $this->email = htmlspecialchars(strip_tags($this->email));
        
        // Asociar el parámetro
        $stmt->bindParam(':email', $this->email);
        
        // Ejecutar la consulta
        $stmt->execute();
        
        // Depuración: Mostrar consulta y parámetros
       // $debug_query = str_replace(':email', $this->conn->quote($this->email), $query);
        //echo "Consulta depurada: " . $debug_query . "<br>";
        
        // Verificar el resultado
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($this->password == $row['password']) {
                return array('success' => true, 'idUsuario' => $row['idUsuario']);
            } else {
                return array('success' => false, 'message' => 'Usuario o contraseña incorrectos');
            }
        }
        
        return array('success' => false, 'message' => 'Usuario o contraseña incorrectos');
    }
    
    
    // Método para registrar un nuevo usuario
    public function register() {
        $query = 'INSERT INTO ' . $this->table . ' SET nombreCompleto = :nombreCompleto, email = :email, password = :password';
        $stmt = $this->conn->prepare($query);

        $this->nombreCompleto = htmlspecialchars(strip_tags($this->nombreCompleto));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->password = htmlspecialchars(strip_tags($this->password)); // Sin encriptar

        $stmt->bindParam(':nombreCompleto', $this->nombreCompleto);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);

        if ($stmt->execute()) {
                return array('success' => true);
            }
            return array('success' => false, 'message' => 'Error al registrar');
        }
}

?>
