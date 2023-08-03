<?php

class DatabaseClass {
  private $host;
  private $username;
  private $password;
  private $database;
  private $connection;

  public function __construct($host, $username, $password, $database) {

    $this->host = $host;
    $this->username = $username;
    $this->password = $password;
    $this->database = $database;

  }

  public function connect() {

    $dsn = "mysql:host=$this->host;dbname=$this->database;charset=utf8mb4";

    try {

      $this->connection = new PDO($dsn, $this->username, $this->password);

      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {

      die("Échec de la connexion à la base de donnée : " . $e->getMessage());
      
    }
    
  }
  
}