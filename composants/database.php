<?php

$userdb = "322965_account";
$pass = 'Leboncoindubled123456789!';

try {

  $db = new PDO('mysql:host=mysql-lemauvaiscoin.alwaysdata.net;dbname=lemauvaiscoin_database', $userdb, $pass);

} catch (PDOException $e) {

  print "Erreur :" . $e->getMessage() . "<br/>";
  die;
  
}