<?php
// $con=mysqli_connect()
?>
<?php
// $servername = "localhost";
// $username = "your_username";
// $password = "your_password";
// $database = "hcc-temp";

// $con = new mysqli($servername, $username, $password, $database);

// if ($con->connect_error) {
//     die("Connection failed: " . $con->connect_error);
// } 
?>

<?php

class Database {
    private $servername = "localhost";
    private $username = "your_username";
    private $password = "your_password";
    private $database = "hcc-temp";
    public $conn;

    public function __construct() {
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        $this->conn->close();
    }
}

?>

