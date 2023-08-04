<?php

require_once 'Database.php';
require_once 'User.php';

$db = new databaseClass();
$conn = $db->getConnection();
$user = new userClass($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $lastname = htmlspecialchars($_POST["lastname"]);
  $firstname = htmlspecialchars($_POST["firstname"]);
  $email = htmlspecialchars($_POST["email"]);
  $password = htmlspecialchars($_POST["password"]);
  $confirmpassword = htmlspecialchars($_POST["confirmpassword"]);
  $number = htmlspecialchars($_POST["number"]);
  $country = htmlspecialchars($_POST["country"]);
  $city = htmlspecialchars($_POST["city"]);

  if ($user->registerUser($lastname, $firstname, $email, $password, $confirmpassword, $number, $country, $city)) {

    echo "<h2 class='success'>Inscription réussie !</h2>";

  } else {

    echo "<h2 class='error'>Erreur lors de l'inscription.</h2>";

  }

}

class CountryFetcher {

  private $apiUrl;

  public function __construct($apiUrl) {

    $this->apiUrl = $apiUrl;

  }

  private function fetchCountries() {

    $response = file_get_contents($this->apiUrl);

    if ($response === false) {

      throw new Exception('Erreur lors de la récupération des données.');

    }

      return json_decode($response, true);

    }

    public function getCountryList() {

      $countries = $this->fetchCountries();

      $countryList = array();

      foreach ($countries as $country) {

        $countryList[] = $country['name']['common'];

      }

        sort($countryList);
        return $countryList;
        
    }
}

$apiUrl = 'https://restcountries.com/v3.1/all';
$countryFetcher = new CountryFetcher($apiUrl);
$countryList = $countryFetcher->getCountryList();

?>

<div class="">
  <form method="POST" action="register.php">
    <div class="bloc-form">
      <label for="country">Nom de famille *</label>
    </div>
    <div class="bloc-form">
      <input type="text" name="lastname" required>
    </div>
    <div class="bloc-form">
      <label for="country">Prénom *</label>
    </div>
    <div class="bloc-form">
      <input type="text" name="firstname" required>
    </div>
    <div class="bloc-form">
      <label for="country">Adresse e-mail</label>
    </div>
    <div class="bloc-form">
      <input type="email" name="email" required>
    </div>
    <div class="bloc-form">
      <label for="country">Mot de passe *</label>
    </div>
    <div class="bloc-form">
      <input type="password" name="password" required>
    </div>
    <div class="bloc-form">
      <label for="country">Confirmer mot de passe</label>
    </div>
    <div class="bloc-form">
      <input type="password" name="confirmpassword" required>
    </div>
    <div class="bloc-form">
      <label for="country">Numéro de téléphone *</label>
    </div>
    <div class="bloc-form">
      <input type="number" name="number" required>
    </div>
    <div class="bloc-form">
      <label for="country">Pays de résidence *</label>
    </div>
    <div class="bloc-form">
      <select name="country" id="country">
        <?php
          foreach ($countryList as $country) {
            echo "<option value=\"$country\">$country</option>";
          }
        ?>
      </select>
    </div>
    <div class="bloc-form">
      <label for="country">Ville de résidence</label>
    </div>
    <div class="bloc-form">
      <input type="city" name="city" required>
    </div>
    <button type="submit" class="btn">Créer mon compte</button>
  </form>
</div>
