<?php
session_start();
require_once "../config/bdd.php";
require_once "../bibliotheque/constante_bdd.php";

$bln_ok = true;

if(isset($_POST['mail_user']) && isset($_POST['password_user'])){

    $mail = htmlspecialchars($_POST['mail_user']);
    $mdp = htmlspecialchars($_POST['password_user']);


    if(!empty($mail) && !empty($mdp)) {

        // prepare SQL request from mail of user

        $select = $bdd->prepare(INSERTION_CONNEXION);
        $select->execute(([$mail]));
        $data = $select->fetch();
    
        // on vérifie le mot de passe en encryptant a nouveau pour comparer les deux cryptages
        if($data != false){
            if(!password_verify($mdp, $data['password_user'])){              
                $bln_ok = false;
                $erreur = "mot de passe ou mail incorrect";
            }               
        }else{
            $bln_ok = false;
            $erreur = "mot de passe ou mail incorrect";          
        }
   }else{
        $bln_ok = false;
        $erreur = "veuillez remplir les champs";      
        }

}else{
    $bln_ok = false;
    echo "il manque des paramètres";
}
if($bln_ok){
   $recup_panier = $bdd->prepare(UPDATE_SESSION_PANIER);
   $recup_panier->execute(array($_SESSION['id_session'], $data['id_user']));
   
}
if(!$bln_ok){
    header("Location: ../Views/connexion.php?error=$erreur");
}
if($bln_ok){

    $session = $bdd->prepare(INSERTION_ROLE_SESSION);
    $session->execute(array($_SESSION['id_session'], $data['id_user']));
    
    if($data['role'] === "admin"){                 
        header("Location: ../Views/admin.php");

    }else if ($data['role'] === "user"){                          
        header("Location: ../index.php");
    }
 }
