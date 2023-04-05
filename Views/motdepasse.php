<?php
session_start();
require_once "../config/bdd.php";

if(isset($_GET['section'])){
    $section = htmlspecialchars($_GET['section']);
}else{
    $section = "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Page de récupération d'un mot de passe après oublie">
    <link rel="stylesheet" href="../asset/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <title>Mot de passe oublié</title>
</head>
<body>

    <header class="headerIndex">
            <div class="Slogan">
                <p>L'antre des Gamer</p>
            </div>
            <div class="navigation">
                <a href="../index.php"><span> Accueil </span></a>
                <a href="./boutique.php"><span> Boutique </span></a>     
                <a href="#"><span>Panier</span></a>
            </div>
            <div class="panier">
            
            </div>
    </header>

    <main class="mainInscription">
    <h4 class="titrePassword">Mot de passe oublié</h4>

<?php 
    if($section == 'code') { 
?>
        Un code de vérification vous a été envoyé par mail: <?= $_SESSION['recup_mail'] ?>

        <form method="post" action="../Models/recover_password.php" class="FormConnexion card">
            <table>
                <tr>
                    <td>
                        <input type="text" placeholder="Code de vérification" name="verif_code">
                    </td>
                </tr>
            </table>  
            
            <?php 
                if(isset($_GET["error"])){
                    echo '<p class="erreur">'. $_GET["error"] .' </p>';
                }
            ?> 

            <button type="submit" name="verif_submit" class="btnConnexion">Valider</button>
        </form>
<?php 
    }elseif($section == "changemdp") { 
?>

        Nouveau mot de passe pour <?= $_SESSION['recup_mail'] ?>

        <form method="post" action="../Models/recover_password.php" class="FormConnexion card">
            <table>
                <tr>
                    <td>
                        <input type="password" placeholder="Nouveau mot de passe" name="change_mdp">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" placeholder="Confirmation du mot de passe" name="change_mdpc">
                    </td>
                </tr>
            </table>       
            
            <?php 
                if(isset($_GET["error"])){
                    echo '<p class="erreur">'. $_GET["error"] .' </p>';
                }
            ?> 

           <button type="submit" name="change_submit" class="btnConnexion">Valider</button>
        </form>
<?php 
    } else { 
?>
        <form method="post" action="../Models/recover_password.php" class="FormConnexion card">
            <table>
                <tr>
                    <td>
                        <input type="email" placeholder="Votre adresse mail" name="recup_mail">
                    </td>
                </tr>
            </table>

            <?php 
                if(isset($_GET["error"])){
                    echo '<p class="erreur">'. $_GET["error"] .' </p>';
                }
            ?> 

            <button type="submit" name="recup_submit" class="btnConnexion"> Valider </button>
        </form>
<?php 
} 
?>
    </main>
</body>
</html>