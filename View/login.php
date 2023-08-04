<?php

require_once '../Controller/databaseClass.php';
require_once '../Controller/userClass.php';

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

<form method="post" action="login.php">
  <div class="bloc-form">
    <input type="email" name="email" placeholder="Adresse e-mail" required>
  </div>
  <div class="bloc-form">
    <input type="password" name="password" placeholder="Mot de passe" required>
  </div>
  <button type="submit">Me connecter</button>
</form>
