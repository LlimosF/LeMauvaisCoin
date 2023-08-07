<?php

require_once ("Controller/databaseClass.php");
require_once ("Controller/carClass.php");

$db = new databaseClass();
$conn = $db->getConnection();
$car = new carClass($conn);

if($_SERVER["REQUEST_METHOD"] === "POST") {

  $brand = htmlspecialchars($_POST["brand"]);
  $model = htmlspecialchars($_POST["model"]);
  $fuel = htmlspecialchars($_POST["fuel"]);
  $power = htmlspecialchars($_POST["power"]);
  $year = htmlspecialchars($_POST["year"]);
  $mileage = htmlspecialchars($_POST["mileage"]);
  $price = htmlspecialchars($_POST["price"]);
  $type = htmlspecialchars($_POST["type"]);
  $gearbox = htmlspecialchars($_POST["gearbox"]);
  $description = htmlspecialchars($_POST["description"]);

    if($car->sellCar($brand, $model, $fuel, $power, $year, $mileage, $price, $type, $gearbox, $description)) {

      echo "<h2 class='success'>Véhicule mit en vente avec succès</h2>";

    } else {

      echo "<h2 class='error'>Erreur lors de la mise en vente du véhicule</h2>";

    }

  }


?>

<h2>Vendre un véhicule</h2>

<form class="form" action="vendre-voiture.php" method="POST">
  <label for="brand">Marque *</label>
  <input type="text" name="brand" required>
  <label for="model">Modèle *</label>
  <input type="text" name="model" required>
  <label for="fuel">Carburant *</label>
  <input type="text" name="fuel" required>
  <label for="power">Chevaux *</label>
  <input type="text" name="power" required>
  <label for="year">Année de mise en circulation *</label>
  <input type="text" name="year" required>
  <label for="mileage">Kilométrage *</label>
  <input type="text" name="mileage" required>
  <label for="price">Prix *</label>
  <input type="text" name="price" required>
  <label for="type">Type *</label>
  <input type="text" name="type" required>
  <label for="gearbox">Boite de vitesse *</label>
  <input type="text" name="gearbox" required>
  <label for="description">Description *</label>
  <input type="text" name="description" required>
  <button type="submit" class="btn">Déposer mon annonce</button>
</form>