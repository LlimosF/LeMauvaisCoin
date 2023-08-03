<?php

class User {

  private $lastname;
  private $firstname;
  private $email;
  private $number;
  private $password;
  private $country;
  private $city;
  private $profilepicture;

  public function __construct($lastname, $firstname, $email, $number, $password, $country, $city, $profilepicture) {

    $this->lastname = $lastname;
    $this->firstname = $firstname;
    $this->email = $email;
    $this->number = $number;
    $this->password = $password;
    $this->country = $country;
    $this->city = $city;
    $this->profilepicture = $profilepicture;

  }

}