<?php
if(!defined('DB_SERVER')){
    require_once("../initialize.php");
}
class DBConnection{

    private $host = DB_SERVER;
    private $username = DB_USERNAME;
    private $password = DB_PASSWORD;
    private $database = DB_NAME;
    
    public $conn;
    
    public function __construct(){

        if (!isset($this->conn)) {
            
            $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);
            
            if (!$this->conn) {
                echo 'Cannot connect to database server';
                exit;
            }            
        }    
        
    }
    public function __destruct(){
        $this->conn->close();
    }
}
class DBConnection2 {

    public $conn2;

    public function __construct() {
        $dsn = "PostgreSQL30"; // Replace with your DSN name
        $user = "postgres";    // Replace with your database username
        $pass = "admin12345"; // Replace with your database password

        if (!isset($this->conn2)) {
            $this->conn2 = odbc_connect($dsn, $user, $pass);

            if (!$this->conn2) {
                die("ODBC Connection Failed: " . odbc_errormsg());
            }   
        }
    }
}
?>

