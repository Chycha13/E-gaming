<?php

require_once "../config/bdd.php";

if(!isset($_SESSION['id_session']) || $_SESSION['id_session'] == ''){
    $_SESSION['id_session'] = session_create_id();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Connectez-vous à notre site e-gaming"> 
    <link rel="stylesheet" href="../asset/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <title>Page connexion</title> 
    <script type="text/javascript" src="../asset/Jquery.js"></script>
    <script src="../js/navigation.js"></script> 
    <script src="../js/menu_burger.js"></script>
    <script src="../js/footer.js"></script>
    <script type="text/javascript">$( document ).ready(function() { 
        remplissage('connexion', '<?=$_SESSION['id_session']?>');
    });  
    </script>
      <script type="text/javascript">$( document ).ready(function() { 
        footer('');
    });  
    </script>
</head>
<body>
<header class="header" id="navigation">
      
    </header>
    <main class="mainInscription">
        <h1 class="titreConnexion">Connexion à votre compte</h1>
        <form method="POST" action="../Models/Connexion_action.php" id="formConnexion" name="formConnexion" class="FormConnexion card">
            <table>
                <tr>
                    <td>
                        <input type="text" placeholder="Mail" id="mail_user" name="mail_user">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" placeholder="Mot de passe" id="password_user" name="password_user">
                    </td>
                </tr>
                
            </table>

            <?php 
                if(isset($_GET["error"])){
                    echo '<p class="erreur">'. $_GET["error"] .' </p>';
                }
            ?> 

            <a href="./motdepasse.php">Mot de passe oublié</a>
            <button class="btnConnexion" type="Submit">Connexion</button>
        </form>

        <div class="card2 card">
            <h2>NOUVEAU CLIENT ?</h2>
            <button onclick="window.location.href = './inscription.php'" class="btnConnexionInscription">Créer un compte</button>
        </div>
       
    
    </main>

    <footer class="footer" id="foot">

    </footer>
</body>
</html>