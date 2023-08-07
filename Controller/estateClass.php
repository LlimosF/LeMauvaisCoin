<?php

class estateClass {

  public $conn;

  public function __construct($db) {

    $this->conn = $db;

  }

  public function sellEstate ($type, $furniture, $numberofpieces, $livingspace, $country, $city, $description, $picture) {

    $type = htmlspecialchars($_POST["type"]);
    $furniture = htmlspecialchars($_POST["furniture"]);
    $numberofpieces = htmlspecialchars($_POST["numberofpieces"]);
    $livingspace = htmlspecialchars($_POST["livingspace"]);
    $country = htmlspecialchars($_POST["country"]);
    $city = htmlspecialchars($_POST["city"]);
    $description = htmlspecialchars($_POST["description"]);

    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {

      $picture = file_get_contents($_FILES["picture"]["tmp_name"]);

      try {

        $sql = 
          "INSERT INTO estate (`type`, `furniture`, `numberofpieces`, `livingspace`, `country`, `city`, `description`, `picture`) 
          VALUES 
          (:type, :furniture, :numberofpieces, :livingspace, :country, :city, :description, :picture)"
        ;

        $query = $this->conn->prepare($sql);
        
        $query->bindParam(":type", $type, PDO::PARAM_STR);
        $query->bindParam(":furniture", $furniture, PDO::PARAM_STR);
        $query->bindParam(":numberofpieces", $numberofpieces, PDO::PARAM_STR);
        $query->bindParam(":livingspace", $livingspace, PDO::PARAM_STR);
        $query->bindParam(":country", $country, PDO::PARAM_STR);
        $query->bindParam(":city", $city, PDO::PARAM_STR);
        $query->bindParam(":description", $description, PDO::PARAM_STR);
        $query->bindParam(":picture", $picture, PDO::PARAM_LOB);

        if($query->execute()) {

          echo "<h2 class='success'>Annonce créé avec succès</h2>";
          return true;

        }

      } catch (PDOException) {

        echo "<h2 class='error'>Erreur lors de la création de l'annonce</h2>";
        return false;

      }

    }  

  }

}