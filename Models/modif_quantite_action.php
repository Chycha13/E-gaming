<?php
require_once "../config/bdd.php";
require_once "../bibliotheque/constante_bdd.php";

   // on met a jour la quantité du produit que l'utilisateur veux acheter

   if(isset($_GET['id_panier']) && isset($_GET['quantite'])){
       if($_GET['quantite'] == 'quantite_plus'){
            $modif_quantite = $bdd->prepare(UPDATE_PRODUIT_PANIER);
            $modif_quantite->execute(array($_GET['id_panier']));
   
        }else{
                $modif_quantite = $bdd->prepare(UPDATE_PRODUIT_PANIER_MOINS);
                $modif_quantite->execute(array($_GET['id_panier']));              
        }
    }