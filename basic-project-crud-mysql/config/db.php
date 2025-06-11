<?php
// config/db.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

class Database
{
  private $host = 'localhost';
  private $dbname = 'crud_app';
  private $username = 'root';
  private $password = '';
  private $conn;

  public function __construct()
  {
    try {
      $dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8mb4";
      $this->conn = new PDO($dsn, $this->username, $this->password);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die("Connection failed: " . $e->getMessage());
    }
  }

  public function getConnection()
  {
    return $this->conn;
  }
}

// connection to database
$db = new Database();
