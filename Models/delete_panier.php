<?php

require_once "../config/bdd.php";
require_once "../bibliotheque/constante_bdd.php";

if(isset ($_GET['id_panier'])){
    $supprimer_produit = $bdd->prepare('DELETE FROM panier WHERE id_panier = ?');
    $supprimer_produit->execute(array($_GET['id_panier']));
}