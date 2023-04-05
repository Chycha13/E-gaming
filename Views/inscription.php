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
    <meta name="description" content="Inscrivez-vous à notre site e-gaming"> 
    <link rel="stylesheet" href="../asset/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300&display=swap" rel="stylesheet">
    <title>Page inscription</title>  
    <script type="text/javascript" src="../asset/jquery.js"></script>
    <script src="../js/menu_burger.js"></script>
    <script src="../js/navigation.js"></script>
    <script src="../js/footer.js"></script> 
    <script type="text/javascript">$( document ).ready(function() { 
        remplissage('inscription' , '<?=$_SESSION['id_session']?>');
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
        <h1 class="titreInscription">Création de compte</h1>
        <form method="POST" action="../Models/inscription_action.php" class="FormInscription card" id="formInscription" name="formInscription">
            <table>
                <tr>
                    <td>
                        <input type="text" placeholder="Nom" id="nom_user" name="nom_user">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" placeholder="Prénom" id="prenom_user" name="prenom_user">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="mail" placeholder="Mail" id="mail_user" name="mail_user">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" placeholder="Adresse" id="adresse_user" name="adresse_user">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" placeholder="Mot de passe" id="password_user" name="password_user">
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="password" placeholder="Mot de passe" id="confirm_password_user" name="confirm_password_user">
                    </td>
                </tr>                                
           </table>
           <?php 
                if(isset($_GET["error"])){
                    echo '<p class="erreur">'. $_GET["error"] .' </p>';
                }
            ?> 

           <button type="submit" class="btnInscription">S'INSCRIRE</button> 
        </form>
            <p class="engagement"> E-gaming s'engage à garder ces informations strictement confidentielles.</p>
    </main>
    <footer id="foot" class="footer">
    </footer>
</body>
</html>