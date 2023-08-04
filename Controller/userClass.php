<?php

class userClass {
  private $conn;

  public function __construct($db) {
      $this->conn = $db;
  }

  public function registerUser($lastname, $firstname, $email, $password, $confirmpassword, $number, $country, $city) {

    $lastname = htmlspecialchars($_POST["lastname"]);
    $firstname = htmlspecialchars($_POST["firstname"]);
    $email = htmlspecialchars($_POST["email"]);
    $confirmpassword = htmlspecialchars($_POST["confirmpassword"]);
    $number = htmlspecialchars($_POST["number"]);
    $country = htmlspecialchars($_POST["country"]);
    $city = htmlspecialchars($_POST["city"]);

    if(filter_var($email, FILTER_VALIDATE_EMAIL)){

      if($password === $confirmpassword){
  
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        
        try {
    
          $query = $this->conn->prepare("INSERT INTO users (lastname, firstname, email, number, password, country, city) VALUES (:lastname, :firstname, :email, :number, :password, :country, :city)");
          $query->bindParam(':lastname', $lastname);
          $query->bindParam(':firstname', $firstname);
          $query->bindParam(':email', $email);
          $query->bindParam(':number', $number);
          $query->bindParam(':password', $hashedPassword);
          $query->bindParam(':country', $country);
          $query->bindParam(':city', $city);
            
          $query->execute();
    
          return true;
    
        } catch (PDOException $exception) {
    
          echo "Erreur d'inscription : " . $exception->getMessage();
          return false;
    
        }

      }
      
    }

  }

  public function loginUser($email, $password) {

    try {

      $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
      $stmt->bindParam(':email', $email);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($user && password_verify($password, $user['password'])) {

        return $user;
      
      } else {

        return null;

      }

    } catch (PDOException $exception) {

      echo "Erreur de connexion : " . $exception->getMessage();
      return null;

    }

  }

}
