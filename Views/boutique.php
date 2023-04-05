<?php
session_start();
require_once "../config/bdd.php";
require_once "../bibliotheque/constante_bdd.php";

    // création d'un id de session unique
    if(!isset($_SESSION['id_session']) || $_SESSION['id_session'] == ''){
        $_SESSION['id_session'] = session_create_id();
    }

    // on récupère la session d'un utilisateur inscrits ou non pour permettre l'utilisation du panier
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
    <meta name="description" content="Ici trouve tout ce qu'il te faut pour explorer le monde du gaming dans les meilleurs conditions avec du matériel haut de gamme">
    <title>Boutique E-gaming</title>
    <link rel="stylesheet" href="../asset/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <script type="text/javascript" src="../asset/Jquery.js"></script>
    <script src="../js/panier.js"></script>
    <script src="../js/navigation.js"></script>
    <script src="../js/menu_burger.js"></script>   
    <script type="text/javascript">$( document ).ready(function() { 
        remplissage('boutique', '<?=$_SESSION['id_session']?>');
    });
    </script>
           <script src="../js/footer.js"></script>
    <script type="text/javascript">$( document ).ready(function() { 
        footer('boutique');
    });
    </script>
</head>
<body>
    <header class="header" id="navigation">

    </header>

    <main class="mainBoutique">
        
    <?php 
    $changement_cat = '';
    $recup_cat = $bdd->query(AFFICHAGE_CATEGORIE);
                       
    while($Cat = $recup_cat->fetch()) {

        if($changement_cat != $Cat['id_categorie']){
            if($changement_cat != ''){
                echo "</div>";
            }
            $changement_cat = $Cat['id_categorie'];

    ?>
            <div class="titreCat">
               <p><strong><?=$Cat['nom_categorie']?></strong></p> 
            </div>
              <div class="categorie">             
    <?php
        }
    ?>
                      
                <div class="produitPlacement">
                    <img src="../asset/img/<?=$Cat['photo_prod']?>" class="imgBoutique"alt="Image du produit">                
                    <p><?=$Cat['nom_prod']?></p>
                    <div class="acheter_boutique">
                            <span class="placementPrix"><?=$Cat['prix_prod']?>€</span>
                            <div class="placement_btn_acheter_boutique">
                                <button class="btnAcheter_boutique" onclick="window.location.href = './produit.php?id_prod=<?=$Cat['id_prod']?>'">Détails</button>
                                <button onclick="addPanier(<?=$Cat['id_prod']?>,'boutique')" class="btnAcheter_boutique">acheter</button>
                            </div>
                        </div>                                               
                </div>         
             
    <?php
    }
    if($changement_cat != ''){
        echo "</div>";
    }
    ?> 
 
    </main>
    <footer class="footer" id="foot">

</footer>
</body>
</html>