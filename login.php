<?php

require_once ("View/component/header.php");
require_once ("Controller/databaseClass.php");
require_once ("Controller/userClass.php");

$db = new databaseClass();
$conn = $db->getConnection();
$user = new userClass($conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  $email = $_POST['email'];
  $password = $_POST['password'];

  $user = $user->loginUser($email, $password);

  if ($user) {

    echo "Connexion réussie !";

  } else {
        
    echo "Identifiants incorrects.";
    
  }

}

?>

<form method="post" action="login.php" class="form">
  <input type="email" name="email" placeholder="Adresse e-mail" required>
  <input type="password" name="password" placeholder="Mot de passe" required>
  <button type="submit" class="btn">Me connecter</button>
</form>
<h3><a href="registration.php" class="link">Besoin d'un compte ?</a></h3>
