<?php
    session_start();
    require_once "../config/bdd.php";
    require_once "../bibliotheque/constante_bdd.php";

    if(empty($_SESSION['id_session'])){
        require_once "./deconnexion.php";
    }
        $recup_user = $bdd->prepare(RECUPERATION_USER_SESSION);
        $recup_user->execute(array($_SESSION['id_session']));
        $user = $recup_user->fetch();

    if (isset ($_POST['nom_user']) && isset ($_POST['prenom_user']) && isset ($_POST['mail_user']) && isset ($_POST['adresse_user']) && isset ($_POST['ville_user']) && isset ($_POST['postal_user'])){

        $nom = htmlspecialchars(($_POST["nom_user"]));
        $prenom  = htmlspecialchars(($_POST["prenom_user"]));
        $mail = htmlspecialchars(($_POST['mail_user']));
        $adresse = htmlspecialchars(($_POST["adresse_user"]));
        $ville = htmlspecialchars(($_POST["ville_user"]));
        $postal = htmlspecialchars(($_POST["postal_user"]));

        
           
        $update = $bdd->prepare(MODIF_PROFIL);
        $update->execute(array($nom, $prenom, $mail, $adresse, $ville, $postal, $user['id_user']));

        header("Location: ../Views/profil.php");
       
    
    } else { 
        $erreur = "une erreur est survenue";
        header("Location:./Views/profil.php?error=$erreur");
    } 
