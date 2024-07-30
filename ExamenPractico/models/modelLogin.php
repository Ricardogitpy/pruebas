
<?php
class ModelLogin {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function login($username, $password) {
        $query = "SELECT * FROM users WHERE username = :username AND password = :password";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            return $user;
        } else {
            return false;
        }
    }
}

?>