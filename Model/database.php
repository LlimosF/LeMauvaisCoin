<?php

$userdb = "322975";
$pass = 'Leboncoindubled123456789!';

try {

  $db = new PDO('mysql:host=mysql-lecoinrond.alwaysdata.net;dbname=lecoinrond_database', $userdb, $pass);

} catch (PDOException $e) {

  print "Erreur :" . $e->getMessage() . "<br/>";
  die;
  
}