<?php
session_start();
    require_once "./config/bdd.php";
    require_once "./bibliotheque/constante_bdd.php";
  

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
    <meta name="description" content="Site de vente de produits gaming professionel">
    <title>Page d'accueil</title>
    <link rel="stylesheet" href="./asset/style.css">
    <script type="text/javascript" src="./asset/Jquery.js"></script>
    <script src="./js/caroussel.js"></script>
    <script src="./js/panier.js"></script>
    <script src="./js/menu_burger.js"></script>
    <script src="./js/navigation.js"></script> 
    <script src="./js/footer.js"></script>  
    <script type="text/javascript">$( document ).ready(function() { 
        remplissage('index' , '<?=$_SESSION['id_session']?>');
    });  
    </script>
    <script type="text/javascript">$( document ).ready(function() { 
        footer('index');
    });  
    </script>
</head>
<body>

    <header class="header" id="navigation" >    
    </header>

    <section class="mainIndex">
        
        <div class="carousel">
            <!-- pictures of the carousel -->
            <div class="carousel_img carousel_img--visible">
                <a><img src="./asset/img/setup1.jpg" alt="Exemple d'équipement"></a>
            </div>

            <div class="carousel_img">
                <a ><img src="./asset/img/setup2.jpg" alt="Exemple d'équipement"></a>
            </div>

            <div class="carousel_img">
                <a><img src="./asset/img/setup3.jpg" alt="Exemple d'équipement"></a>
            </div>

            <div class="carousel_actions">
                <!-- button left and right for change the carousel picture -->
                <button id="carousel_button_prev">&#8249;</button>
                <button id="carousel_button_next">&#8250;</button>              
            </div>
            
        </div>
        <div class="placement_titre_accueil"><h1><strong> Les plus populaires : </strong></h1></div>
       <div class="container">
<?php

  // on récupère les produits et la catégorie

  $recup_cat = $bdd->query(AFFICHAGE_CATEGORIE_ACCUEIL);                
  while($Cat = $recup_cat->fetch()) {
  
?>
            <div class="containerCard">
                <div class="card">
                <span class="nomProd"><strong><?=$Cat['nom_prod']?></strong></span>
                    <div class="placementImage">
                        <img src="./asset/img/<?=$Cat['photo_prod']?>" width="60% "   alt="photo de l'article">
                    </div>                    
                    <div class="textProduit">
                        
                        <div class="acheter">
                            <span class="prix">Prix : <?=$Cat['prix_prod']?>€</span>
                            <div class="placement_btn_acheter">
                                <button class="btnAcheter" onclick="window.location.href = './Views/produit.php?id_prod=<?=$Cat['id_prod']?>'">DETAILS</button>
                                <button onclick="addPanier(<?=$Cat['id_prod']?> , 'index')" class="btnAcheter">ACHETER</button>
                            </div>
                        </div>
                    </div>                  
                </div>
           </div>
<?php
  }
?>
        </div>
    </section>


<footer class="footer" id="foot">
 
</footer>
  
</body>

</html>