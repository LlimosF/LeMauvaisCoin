<?php

class clothingClass {

  public $conn;

  public function __construct($db) {

    $this->conn = $db;

  }

  public function sellClothing($universe, $size, $state, $type, $color, $country, $city, $send, $description, $picture) {

    $universe = htmlspecialchars($_POST["universe"]);
    $size = htmlspecialchars($_POST["size"]);
    $state = htmlspecialchars($_POST["state"]);
    $type = htmlspecialchars($_POST["type"]);
    $color = htmlspecialchars($_POST["color"]);
    $country = htmlspecialchars($_POST["country"]);
    $city = htmlspecialchars($_POST["city"]);
    $description = htmlspecialchars($_POST["description"]);

    if (isset($_FILES["picture"]) && $_FILES["picture"]["error"] === UPLOAD_ERR_OK) {

      $picture = file_get_contents($_FILES["picture"]["tmp_name"]);

      try {

        $sql = 
          "INSERT INTO clothing (`universe`, `size`, `state`, `type`, `color`, `country`, `city`, `send`, `description`, `picture`) 
          VALUES 
          (:universe, :size, :state, :type, :color, :country, :city, :send, :description, :picture)"
        ;

        $query = $this->conn->prepare($sql);

        $query->bindParam(":universe", $universe, PDO::PARAM_STR);
        $query->bindParam(":size", $size, PDO::PARAM_STR);
        $query->bindParam(":state", $state, PDO::PARAM_STR);
        $query->bindParam(":type", $type, PDO::PARAM_STR);
        $query->bindParam(":color", $color, PDO::PARAM_STR);
        $query->bindParam(":country", $country, PDO::PARAM_STR);
        $query->bindParam(":city", $city, PDO::PARAM_STR);
        $query->bindParam(":send", $send, PDO::PARAM_STR);
        $query->bindParam(":description", $description, PDO::PARAM_STR);
        $query->bindParam(":picture", $picture, PDO::PARAM_LOB);

      } catch (PDOException) {

        echo "<h2 class='error'>Erreur lors de la création de l'annonce</h2>";
        return false;

      }

    }

  }

}