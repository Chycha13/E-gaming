<?php
require_once "../config/bdd.php";
require_once "../bibliotheque/constante_bdd.php";

   //check if table are correct
if(isset($_POST['nom_user']) && isset($_POST['prenom_user']) && isset($_POST['mail_user']) && isset($_POST['adresse_user'])
                             && isset($_POST['password_user']) && isset($_POST['confirm_password_user'])){

// create variable for convert special char on html entity
        $nom = htmlspecialchars(($_POST["nom_user"]));
        $prenom  = htmlspecialchars(($_POST["prenom_user"]));
        $mail = htmlspecialchars(($_POST["mail_user"]));  
        $adresse = htmlspecialchars(($_POST["adresse_user"]));
        $mdp = htmlspecialchars(($_POST["password_user"]));
        $confirmeMdp = htmlspecialchars($_POST["confirm_password_user"]);

// check if cases is not empty
    if (!empty($nom) && !empty($prenom) && !empty($mail) && !empty($adresse) && !empty($mdp) && !empty($confirmeMdp)) {               
        // check if validate mail           
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {   
            //if password are correct we prepare and execute request SQL  
            if($mdp == $confirmeMdp){           
                $mdp = password_hash($mdp, PASSWORD_DEFAULT);
                $role = "user";
                $insert = $bdd->prepare(INSERTION_INSCRIPTION);
                $insert->execute([$nom,$prenom,$mail,$adresse,$mdp,$role]);
       
                    $success = "Inscription réussie";
                    header("Location: ../Views/connexion.php?success=$success");

                }else{
                    $erreur = " Le mot de passe n'est pas identique";
                    header("Location:../Views/inscription.php?error=$erreur");
                }

        }else{
            $erreur = "veuillez entrez un mail valide";
            header("Location: ../Views/inscription.php?error=$erreur");
        }
    }else{
        $erreur = "veuillez remplir les champs" ;
        header("Location: ../Views/inscription.php?error=$erreur");
    } 
}