<?php
session_start();
require_once "../config/bdd.php";
require_once "../bibliotheque/constante_bdd.php";



if(!isset($_SESSION['id_session']) || $_SESSION['id_session'] == ''){
    $_SESSION['id_session'] = session_create_id();
}

$recup_role = $bdd->prepare(GET_SESSION);
$recup_role->execute(array($_SESSION['id_session']));
$role = $recup_role->fetch();

$id_prod = $_GET['id_prod'];

$detail_prod = $bdd->prepare(AFFICHAGE_PRODUIT_DETAIL);
$detail_prod->execute(array($id_prod));
$detail = $detail_prod->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page explicant les détails du produit qui est en vente">
    <title>Détail du produit</title>
    <link rel="stylesheet" href="../asset/style.css">
    <script type="text/javascript" src="../asset/Jquery.js"></script>
    <script src="../js/footer.js"></script>
    <script src="../js/menu_burger.js"></script>
    <script type="text/javascript">$( document ).ready(function() { 
        footer('produit');
    });  
    </script>
      <script src="../js/navigation.js"></script>   
    <script type="text/javascript">$( document ).ready(function() { 
        remplissage('produit', '<?=$_SESSION['id_session']?>');
    });
    </script>
</head>
<body>
    
<header class="header" id="navigation">
     
</header>

<main class="mainProfil">
    <div class="cardProduit">
    <h1><?= $detail['nom_prod']?></h1>
        <img src="../asset/img/<?=$detail['photo_prod']?>" width="30% "   alt="photo de l'article">
          <div class="descProd">         
            <div class="detailProduit">
        
                <p> <strong>Description :</strong> <br>
                    <br><?=$detail['desc_prod']?></p>
                        
            </div>
            <div class="achat">
                <span class="alignPrix"> Prix : <?=$detail['prix_prod']?>€</span>
                <button onclick="addPanier(<?=$detail['id_prod']?> , 'produit')" class="btnAcheterProduit">ACHETER</button>
            </div>
          </div>
    </div>
</main>
<footer class="footer" id="foot">

</footer>
</body>
</html>