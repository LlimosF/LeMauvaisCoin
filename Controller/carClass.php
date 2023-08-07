<?php

class carClass {

  private $conn;

  public function __construct($db) {

    $this->conn = $db;
    $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  }

  public function sellCar($brand, $model, $fuel, $power, $year, $mileage, $price, $type, $gearbox, $description) {

    try {

      $sql = "INSERT INTO vehicule 
        (`brand`, `model`, `fuel`, `power`, `year`, `mileage`, `price`, `type`, `gearbox`, `description`) 
        VALUES 
        (:brand, :model, :fuel, :power, :year, :mileage, :price, :type, :gearbox, :description)"
      ;

      $query = $this->conn->prepare($sql);

      $query->bindParam(":brand", $brand, PDO::PARAM_STR);
      $query->bindParam(":model", $model, PDO::PARAM_STR);
      $query->bindParam(":fuel", $fuel, PDO::PARAM_STR);
      $query->bindParam(":power", $power, PDO::PARAM_INT);
      $query->bindParam(":year", $year, PDO::PARAM_INT);
      $query->bindParam(":mileage", $mileage, PDO::PARAM_INT);
      $query->bindParam(":price", $price, PDO::PARAM_INT);
      $query->bindParam(":type", $type, PDO::PARAM_STR);
      $query->bindParam(":gearbox", $gearbox, PDO::PARAM_STR);
      $query->bindParam(":description", $description, PDO::PARAM_STR);

      if ($query->execute()) {

        return true;

      } else {

        return false;

      }

    } catch (PDOException $e) {

      echo "Erreur SQL : " . $e->getMessage();

      return false;
    }
  
  }

  }
