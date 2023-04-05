<?php
session_start();
    require_once "../config/bdd.php";
    require_once "../bibliotheque/constante_bdd.php";

    $recup_role = $bdd->prepare(GET_SESSION);
    $recup_role->execute(array($_SESSION['id_session']));
    $role = $recup_role->fetch();

    if(!isset($role['role']) || $role['role'] != 'admin'){ 
        require_once "../Models/deconnexion.php";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Votre page administration pour ajouter , modifier , supprimer des articles ou des utilisateurs">
    <title>Page d'administration</title>
    <link rel="stylesheet" href="../asset/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <script type="text/javascript" src="../asset/jquery.js"></script>
    <script src="../js/popup_admin.js"></script> 
    <script src="../js/navigation.js"></script>
    <script src="../js/menu_burger.js"></script>  
        <script type="text/javascript">$( document ).ready(function() { 
            remplissage('admin', '<?=$_SESSION['id_session']?>');
        });
        </script> 
</head>
<body>
    <header class="header" id="navigation">
         
    </header>
    <main class="mainAdmin">
        <h1 class="TitreAdmin">Administration :</h1>
        <div class="PlacementTableau">
        <div class="container2">
            <div class="card3">
                <h4>UTILISATEURS</h4>
                <table class="tableAdmin">
                    <tr class="TRcolor">
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Gestion Rôles</th>
                        <th>Suppression</th>                   
                    </tr>                  
                <?php
                // SQL request with while 
                    $recup_user = $bdd->query(SHOW_USER);                   
                    while($user = $recup_user->fetch()) {               
                ?>
                    <tr class="TRcolor">
                        <th><?=$user['nom_user']?></th>
                        <th><?=$user['prenom_user']?></th>
                        <th><?=$user['mail_user']?></th>
                        <form action="role.php" method="POST">
                            <th><?=$user['role']?></th>
                            <th><a id="linkColor" href="../Models/role_action.php?id_user=<?=$user['id_user']?>">Switch</a></th>
                            <th><a id="linkColor" href="../Models/suppression_action.php?Delete=<?=$user['id_user']?>" >Supprimer</a></th>                                    
                        </form>    
                    </tr>
                <?php
                }
                ?>
                </table>                          
            </div>
        </div>
        <hr class="separation">
        <div class="container5">
            <div class="card3">
                <h5>PRODUITS</h5>
                <table class="tableAdmin">
                    <tr class="TRcolor">
                        <th>Nom du produit</th>
                        
                        <th>prix du produit ( € )</th>                                              
                        <th>modifier</th>
                        <th>Suppression</th>                      
                    </tr>
                    <?php
                    $recup_prod = $bdd->query(SHOW_PROD);                   
                    while($prod = $recup_prod->fetch()) {               
                    ?>
                        <tr class="TRcolor">
                            <th><?=$prod['nom_prod']?></th>
                            <th><?=$prod['prix_prod']?></th>
                            <th><button id="linkColor2" onclick="openModal(<?=$prod['id_prod']?>, 'modif')" href="">Modifier</button></th>               
                            <th><a id="linkColor" href="../Models/suppression_action.php?Delete=<?=$prod['id_prod']?>">Supprimer</a></th>                                     
                        </tr>
                    <?php
                    }
                    ?>
                </table>
            </div>
                <button onclick="openModal('', 'ajout')" class="btnProduct"> Ajouter Produits </button>
            </div>
        </div>

        <div id="popUp">
        
        </div>
   
    </main>
</body>
</html>