<?php
session_start();
require_once "../config/bdd.php";
require_once "../bibliotheque/constante_bdd.php";

// on récupère la session utilisateur
$recup_role = $bdd->prepare(GET_SESSION);
$recup_role->execute(array($_SESSION['id_session']));
$role = $recup_role->fetch();

?>

<!DOCTYPE html>
<html lang="en">

<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Page panier</title>
        <meta name="description" content="Votre panier avec les articles sur lesquels vous avez craqués">
        <title>Boutique E-gaming</title>
        <link rel="stylesheet" href="../asset/style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
        <script type="text/javascript" src="../asset/Jquery.js"></script>
        <script src="../js/panier.js"></script>
        <script src="../js/menu_burger.js"></script>
        <script src="../js/navigation.js"></script>  
        <script src="../js/footer.js"></script>
        <script type="text/javascript">id_session ='<?=$_SESSION['id_session']?>'
        </script>  
</head>

<body>
   <header class="header" id="navigation">
    </header>
        <main class="mainPanier">
                <?php
                $recup_panier = $bdd->prepare(RECUPERATION_PANIER);
                $recup_panier->execute(array($_SESSION['id_session']));

                if ($recup_panier->rowCount() == 0) {
                ?>

                <div class="PanierVide">
                    <section >
                        <p class="titre_panierVide"><strong>MON PANIER</strong></p>
                        <div class="containerCard_panierVide">
                            <div class="cardPanier">
                                <div class="Alignement1">
                                    <p>Il n'y rien dans votre panier.</p>
                                    <p>Notre boutique dispose d'un large choix de matériel gaming a votre disposition
                                        en vous dirigeant sur notre : <a href="./boutique.php">boutique</a>
                                    </p>
                                </div>
                            </div>
                        </div>


                    </section>
                </div>
                <?php
                } else {
                ?>
                <div class="Panier">
                     <section class="section_produit">
                        <p class="TitrePanier"><strong>MON PANIER</strong></p>
                        <div class="containerCard_panier">
                            <div class="cardPanier" id="suppr">
                                <?php
                                while ($panier = $recup_panier->fetch()) {
                                ?>
                                    <div class="Alignement">
                                        <img src="../asset/img/<?= $panier['photo_prod'] ?>" class="imgPanier" width="20%" alt="photo de l'article">                                      
                                        <div class="textProduit_panier">
                                            <p><strong><?= $panier['nom_prod'] ?></strong></p>
                                            <div class="acheter_panier">
                                                <p> prix: <?= $panier['prix_prod'] ?>€</p>                                                                                         
                                            </div> 
                                            <div class="quantite_produit">
                                                <button class="btn_quantite2" onclick="modifQuantite(<?=$panier['id_panier']?>, 'quantite_moins')">-</button>
                                                <p class="quantite_nombre"><?=$panier['quantite']?></p>
                                                <button class="btn_quantite" onclick="modifQuantite(<?=$panier['id_panier']?>, 'quantite_plus')">+</button>
                                            </div>
                                        </div>
                                       
                                        <button onclick="removeProduct(<?=$panier['id_panier']?>)" class="closeStyle3">
                                            <img src="../asset/img/pngwing.com.png" class="cross"  alt="Croix de fermeture fenêtre">
                                        </button>
                                    </div>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </section>

                    <section class="section_achat">
                        <p class="TitrePanier2"><strong>TOTAL</strong></p>
                        <div class="containerCard_achat">
                            <div class="cardPanier2">
                                <?php
                                $total = 0 ;
                                $recup_panier = $bdd->prepare(RECUPERATION_PANIER);
                                $recup_panier->execute(array($_SESSION['id_session']));
                                while ($panier = $recup_panier->fetch()) {
                                    $prix = $panier['prix_prod'];
                                    $quantite = $panier['quantite'];
                                    $total +=  $prix * $quantite;                                    
                                ?>
                                
                                        <li>
                                            <span><?= $panier['prix_prod'] ?>€</span>
                                            <span> quantité = <?= $panier['quantite'] ?></span>                                                                                    
                                        </li>
                                    
                                <?php                              
                                } 
                                ?>
                                <p> prix total = <?=$total?> €</p>
                            </div>
                        
                            <div class="cardPanier3">
                                <div class="paiementPanier">
                                    <h4 >PAIEMENTS</h4>
                                    <img src="../asset/img/CB-1.jpg" width="30%" alt="image carte bleue">
                                    <br>
                                    <img src="../asset/img/Paypal_2007_logo.svg_-1.png"  width="30%" alt="image de paypal">       
                                </div>
                                <div class="livraisonPanier">
                                    <h4>LIVRAISONS</h4>
                                    <img src="../asset/img/colissimo.png" width="30%"  alt="logo colissimo">
                                    <br>
                                    <img src="../asset/img/dpd.png" width="30%" alt="logo dpd">
                                
                                </div>
                            </div>
                        </div>
                        <button class="btnCommander">COMMANDER</button>
                    </section>
                </div>
                <?php
                }
                ?>
                
        </main>

        <footer class="footer" id="foot">
        </footer>
</body>

</html>