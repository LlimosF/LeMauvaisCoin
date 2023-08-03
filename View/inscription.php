<?php

require_once("../Controller/userClass.php");
require_once("../Controller/registrationClass.php");
require_once("../Controller/databaseClass.php");

?>

<div class="">
  <form method="POST">
    <div class="bloc-form">
      <input type="text" name="lastname" placeholder="Nom de famille" required>
    </div>
    <div class="bloc-form">
      <input type="text" name="firstname" placeholder="Prénom" required>
    </div>
    <div class="bloc-form">
      <input type="email" name="email" placeholder="Adresse e-mail" required>
    </div>
    <div class="bloc-form">
      <input type="password" name="password" placeholder="Mot de passe" required>
    </div>
    <div class="bloc-form">
      <input type="password" name="confirmpassword" placeholder="Confirmer mot de passe" required>
    </div>
    <div class="bloc-form">
      <input type="number" name="number" placeholder="Numéro de téléphone" required>
    </div>
    <div class="bloc-form">
      <input type="country" name="country" placeholder="Pays de résidence" required>
    </div>
    <div class="bloc-form">
      <input type="city" name="city" placeholder="Ville de résidence" required>
    </div>
    <div class="bloc-form">
      <input type="file" name="profilepicture" required>
    </div>
    <button type="submit" class="btn">Créer mon compte</button>
  </form>
</div>