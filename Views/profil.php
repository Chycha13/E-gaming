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

if (isset ($role['id_user'])){
    $rec_inf = $bdd->prepare(SELECT_USER);
    $rec_inf->execute(array($role['id_user']));
    $info = $rec_inf->fetch();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page profil d'E-gaming, ici modifie ton addresse de livraison">
    <title>Boutique E-gaming</title>
    <link rel="stylesheet" href="../asset/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <script type="text/javascript" src="../asset/Jquery.js"></script>
    <script src="../js/navigation.js"></script>
    <script src="../js/menu_burger.js"></script>
    <script type="text/javascript">$( document ).ready(function() { 
        remplissage('profil', '<?=$_SESSION['id_session']?>');
    });
    </script>
   
</head>
<body>
    <header class="header" id="navigation">  
    </header>

    <main class="mainInscription">
    <?php 
        if($role['role'] == 'admin'){
    ?>
        <div class="placementAdmin">
        <a href="admin.php"> <button class="btnAdmin">Accés admin</button></a>
        </div>

    <?php    
        }
    ?>
  
        <h1 class="titreProfil">Adresse de livraison</h1>


        <form method="POST" action="../Models/profil_action.php" id="formConnexion" name="formConnexion" class="FormProfil card">
            <table>
                <tr>
                    <td>
                        <label for="">Nom :</label>
                        <input type="text" value="<?=$info['nom_user'];?>" id="nom_user" name="nom_user">
                        
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="">Prénom :</label>
                        <input type="text" value="<?=$info['prenom_user'];?>" id="prenom_user" name="prenom_user">
                    </td>
                </tr>
                <tr>
                    <td>
                    <label for="">Mail :</label>
                        <input type="text" value="<?=$info['mail_user'];?>" id="mail_user" name="mail_user">
                    </td>
                </tr>
                <tr>
                    <td>
                    <label for="">Adresse :</label>
                        <input type="text" value="<?=$info['adresse_user'];?>" id="adresse_user" name="adresse_user">
                    </td>
                </tr>
                <tr>
                    <td>
                    <label for="">Ville :</label>
                        <input type="text" value="<?=$info['ville_user'];?>" id="ville_user" name="ville_user">
                    </td>
                </tr>
                <tr>
                    <td>
                    <label for="">Code postal :</label>
                        <input type="text" value="<?=$info['postal_user'];?>" id="postal_user" name="postal_user">
                    </td>
                </tr>
                
            </table>

            <?php 
                if(isset($_GET["error"])){
                    echo '<p class="erreur">'. $_GET["error"] .' </p>';
                }
            ?> 
            
            <button class="btnConnexion" type="Submit">Valider</button>
        </form>
    
    </main>  
    </body>
    </html>