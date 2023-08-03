<?php

class DatabaseClass {
  private $host;
  private $username;
  private $passworddb;
  private $database;
  private $connection;

  public function __construct($host, $username, $passworddb, $database) {

    $this->host = $host;
    $this->username = $username;
    $this->passworddb = $passworddb;
    $this->database = $database;

    $host = "mysql-lecoinrond.alwaysdata.net";
    $username = "322975";
    $passworddb = "Leboncoindubled123456789!";
    $database = "lecoinrond_database";

  }

  public function connect() {

    $dsn = "mysql:host=$this->host;dbname=$this->database;charset=utf8mb4";

    try {

      $this->connection = new PDO($dsn, $this->username, $this->passworddb);

      $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {

      die("Échec de la connexion à la base de donnée : " . $e->getMessage());
      
    }
    
  }

  public function prepareQuery($query) {

    if (!$this->connection) {

      $this->connect();

    }

    try {

      $statement = $this->connection->prepare($query);
      return $statement;

    } catch (PDOException $e) {

      die("Erreur lors de la préparation de la requête : " . $e->getMessage());

    }
  }
}