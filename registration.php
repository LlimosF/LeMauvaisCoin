<?php

require_once ("View/component/header.php");
require_once ("Controller/databaseClass.php");
require_once ("Controller/userClass.php");

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
  <form method="POST" action="register.php" class="form">
      <label for="country">Nom de famille *</label>
      <input type="text" name="lastname" required>
      <label for="country">Prénom *</label>
      <input type="text" name="firstname" required>
      <label for="country">Adresse e-mail</label>
      <input type="email" name="email" required>
      <label for="country">Mot de passe *</label>
      <input type="password" name="password" required>
      <label for="country">Confirmer mot de passe</label>
      <input type="password" name="confirmpassword" required>
      <label for="country">Numéro de téléphone *</label>
      <input type="number" name="number" required>
      <label for="country">Pays de résidence *</label>
      <select name="country" id="country">
        <?php
          foreach ($countryList as $country) {
            echo "<option value=\"$country\">$country</option>";
          }
        ?>
      </select>
      <label for="country">Ville de résidence</label>
      <input type="city" name="city" required>
    <button type="submit" class="btn">Créer mon compte</button>
  </form>
</div>
<h3><a href="login.php" class="link">Déjà un compte ?</a></h3>