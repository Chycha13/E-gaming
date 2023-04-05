<?php
session_start();
require_once "../config/bdd.php";
require_once "../bibliotheque/constante_bdd.php";

  $id_user = 0 ;

if(isset($_GET['id_prod']) && isset($_SESSION['id_session'])){
    // récupération de l'id utilisateur de la session
    $recup_user = $bdd->prepare(RECUPERATION_USER_SESSION);
    $recup_user->execute(array($_SESSION['id_session']));
    $user = $recup_user->fetch();

    // si l'utilisateur existe nous remplissons la variable 'id_user'
if(!empty($user['id_user'])){
    $id_user = $user['id_user'];
}
    //on vérifie si un produit à déja était ajouté au panier
    $verif_article = $bdd->prepare(VERIFICATION_PANIER);
    $verif_article->execute(array($id_user, $_SESSION['id_session'], $_GET['id_prod']));
    $verif = $verif_article->fetch();

    //Si un produit à déja etait ajouté nous le mettons a jour
if(!empty($verif['id_panier'])){

    $quantite_prod = $bdd->prepare(UPDATE_PRODUIT_PANIER);
    $quantite_prod->execute(array($verif['id_panier']));
   

    }else{
        // on insère le produit dans le panier
        $insert_panier = $bdd->prepare(INSERTION_PANIER);
        $insert_panier->execute(array($id_user, $_GET['id_prod'],$_SESSION['id_session']));
    }
}

 