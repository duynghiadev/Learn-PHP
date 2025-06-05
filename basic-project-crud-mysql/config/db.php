<?php
// config/db.php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'crud_app');

class Database
{
  private $conn;

  public function __construct()
  {
    $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($this->conn->connect_error) {
      die("Connection failed: " . $this->conn->connect_error);
    }
  }

  public function getConnection()
  {
    return $this->conn;
  }
}

$db = new Database();
