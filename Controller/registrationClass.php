<?php


class registrationClass extends userClass {

  public function registration ($lastname, $firstname, $email, $password, $confirmpassword, $number, $country, $city, $profilepicture) {

    $lastname = htmlspecialchars($_POST["lastname"]);
    $firstname = htmlspecialchars($_POST["firstname"]);
    $email = htmlspecialchars($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_ARGON2ID);
    $confirmpassword = htmlspecialchars($_POST["confirmpassword"]);
    $number = htmlspecialchars($_POST["number"]);
    $country = htmlspecialchars($_POST["country"]);
    $city = htmlspecialchars($_POST["city"]);
    $profilepicture = file_get_contents($_FILES["profilepicture"]["tmp_name"]);

    if(filter_var($email, FILTER_VALIDATE_EMAIL)){

      if($password === $confirmpassword){

        require_once("databaseClass.php");

        $db = new DatabaseClass($host, $username, $passworddb, $database);

        $registration = 
          "INSERT INTO `users`(`lastname`, `firstname`, `email`, `number`, `password`, `country`, `city`, `profilepicture`) 
          VALUES 
          (:lastname, :firstname, :email, :number, :password, :country, :city, :profilepicture)"
        ;

        $query = $db->prepareQuery($registration);

        $query->bindParam(":lastname", $lastname, PDO::PARAM_STR);
        $query->bindParam(":firstname", $firstname, PDO::PARAM_STR);
        $query->bindParam(":email", $email, PDO::PARAM_STR);
        $query->bindParam(":password", $password, PDO::PARAM_STR);
        $query->bindParam(":number", $number, PDO::PARAM_INT);
        $query->bindParam(":country", $country, PDO::PARAM_STR);
        $query->bindParam(":city", $city, PDO::PARAM_STR);
        $query->bindParam(":profilepicture", $profilepicture, PDO::PARAM_LOB);

        $query->execute();

        if($query->execute()){

          echo "T'es bien inscrit mec gg wp t'es trop chaud";

        } else {

          echo "Ah pas marche";

        }

      } else {

        echo "T''ees nul fdp";

      }

    } else {

      echo "ff bot";

    }

  } 

}