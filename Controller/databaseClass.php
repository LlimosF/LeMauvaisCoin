<?php

class databaseClass {

  private $host = "mysql-lecoinrond.alwaysdata.net";
  private $db_name = "lebonrond_database";
  private $username = "322975";
  private $password = "Leboncoindubled123456789!";
  private $conn;

  public function getConnection(){

    $this->conn = null;

    try {

      $this->conn = new PDO (

        "mysql:host=" . $this->host. ";dbname=" . $this->db_name,
        $this->username,
        $this->password

      );

      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $exception) {

      echo "Erreur de connexion : " . $exception->getMessage();

    }

    return $this->conn;

  }

}