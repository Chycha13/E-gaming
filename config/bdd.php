<?php
  // try to connect on BDD but if he dectect one exeption catch take it.
  try{
      $bdd = new PDO("mysql:host=localhost;dbname=e-gaming;", 'root', '');

  }catch(PDOException $e) {
      echo "erreur : ". $e->getMessage();
  }