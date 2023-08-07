<?php

class carClass {

  private $conn;

  public function __construct($db) {

    $this->conn = $db;

  }

  public function sellCar($brand, $model, $fuel, $power, $year, $mileage, $price, $type, $gearbox, $picture) {

    $brand = htmlspecialchars($_POST["brand"]);
    $model = htmlspecialchars($_POST["model"]);
    $fuel = htmlspecialchars($_POST["fuel"]);
    $power = htmlspecialchars($_POST["power"]);
    $year = htmlspecialchars($_POST["year"]);
    $mileage = htmlspecialchars($_POST["mileage"]);
    $price = htmlspecialchars($_POST["price"]);
    $type = htmlspecialchars($_POST["type"]);
    $gearbox = htmlspecialchars($_POST["gearbox"]);
    $picture = htmlspecialchars($_POST["picture"]);

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {

      $picture = file_get_contents($_FILES["picture"]["tmp_name"]);

      try {

        $sql = 
          "INSERT INTO cars (`brand`, `model`, `fuel`, `power`, `year`, `mileage`, `price`, `type`, `gearbox`, `picture`) 
          VALUES 
          (:brand, :model, :fuel, :power, :year, :mileage, :price, :type, :gearbox, :picture)"
        ;

        $query = $this->conn->prepare($sql);
        $query->bindParam(":brand", $brand, PDO::PARAM_STR);
        $query->bindParam(":model", $model, PDO::PARAM_STR);
        $query->bindParam(":fuel", $fuel, PDO::PARAM_STR);
        $query->bindParam(":power", $power, PDO::PARAM_STR);
        $query->bindParam(":year", $year, PDO::PARAM_STR);
        $query->bindParam(":mileage", $mileage, PDO::PARAM_STR);
        $query->bindParam(":price", $price, PDO::PARAM_STR);
        $query->bindParam(":type", $type, PDO::PARAM_STR);
        $query->bindParam(":gearbox", $gearbox, PDO::PARAM_STR);
        $query->bindParam(":picture", $picture, PDO::PARAM_STR);

        $query->execute();

        if($query->execute()) {

          echo "<h2 class='success'>Annonce créé avec succès</h2>";
          return true;

        }

      } catch (PDOException $exception) {

        echo "<h2 class='error'>Erreur lors de la création de l'annonce</h2>";
        return false;

      }

    }

  }

}