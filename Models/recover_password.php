<?php
session_start();
require_once "../config/bdd.php";

$bln_ok = true;

if(isset($_GET['section'])){
    $section = htmlspecialchars($_GET['section']);
}else{
    $section = "";
}

if(isset($_POST['recup_submit'],$_POST['recup_mail'])) {
    if(!empty($_POST['recup_mail'])) {

       $recup_mail = htmlspecialchars($_POST['recup_mail']);

       if(filter_var($recup_mail,FILTER_VALIDATE_EMAIL)) {

          $mailexist = $bdd->prepare('SELECT id_user, nom_user FROM users WHERE mail = ?');
          $mailexist->execute(array($recup_mail));
          $mailexist_count = $mailexist->rowCount();

          if($mailexist_count == 1) {
             $pseudo = $mailexist->fetch();
             $pseudo = $pseudo['nom_user'];
             
             $_SESSION['recup_mail'] = $recup_mail;
             $recup_code = "";

             for($i=0; $i < 8; $i++) {
                $recup_code .= mt_rand(0,9);
             }

             $mail_recup_exist = $bdd->prepare('SELECT id_rec FROM recuperation WHERE mail = ?');
             $mail_recup_exist->execute(array($recup_mail));
             $mail_recup_exist = $mail_recup_exist->rowCount();

             if($mail_recup_exist == 1) {

                $recup_insert = $bdd->prepare('UPDATE recuperation SET code = ? WHERE mail = ?');
                $recup_insert->execute(array($recup_code,$recup_mail));

             } else {

                $recup_insert = $bdd->prepare('INSERT INTO recuperation(mail,code) VALUES (?, ?)');
                $recup_insert->execute(array($recup_mail,$recup_code));
             }

          $header="MIME-Version: 1.0\r\n";
          $header.='From:"[E-gaming]"<r.toutain@gmail.com>'."\n";
          $header.='Content-Type:text/html; charset="utf-8"'."\n";
          $header.='Content-Transfer-Encoding: 8bit';
          $message = '
          <html>
          <head>
           <title>Récupération de mot de passe - E-gaming</title>
           <meta charset="utf-8" />
          </head>
          <body>
           <font color="#303030";>
             <div align="center">
                <table width="600px">
                 <tr>
                   <td>
                      
                      <div align="center">Bonjour <b>'.$pseudo.'</b>,</div>
                      Voici votre code de récupération: <b>'.$recup_code.'</b>
                      A bientôt sur <a href="#">www.E-gaming.com</a> !
                      
                   </td>
                 </tr>
                 <tr>
                   <td align="center">
                      <font size="2">
                       Ceci est un email automatique, merci de ne pas y répondre
                      </font>
                   </td>
                 </tr>
                </table>
             </div>
            </font>
          </body>
          </html>
          ';
          mail($recup_mail, "Récupération de mot de passe - E-gaming", $message, $header);
             header("Location:http://localhost/gaming-php/Views/motdepasse.php?section=code");
          } else {
              
             $erreur = "Cette adresse mail n'est pas enregistrée";
             header("Location: ../Views/motdepasse.php?error=$erreur");
          }
       } else {
        
          $erreur = "Adresse mail invalide";
          header("Location: ../Views/motdepasse.php?error=$erreur");
       }
    } else {
      
       $erreur = "Veuillez entrer votre adresse mail";
       header("Location: ../Views/motdepasse.php?error=$erreur");
    }
 }


 if(isset($_POST['verif_submit'],$_POST['verif_code'])) {

    if(!empty($_POST['verif_code'])) {

       $verif_code = htmlspecialchars($_POST['verif_code']);
       $verif_req = $bdd->prepare('SELECT id_rec FROM recuperation WHERE mail = ? AND code = ?');
       $verif_req->execute(array($_SESSION['recup_mail'],$verif_code));
       $verif_req = $verif_req->rowCount();

       if($verif_req == 1) {
          $up_req = $bdd->prepare('UPDATE recuperation SET confirme = 1 WHERE mail = ?');
          $up_req->execute(array($_SESSION['recup_mail']));
          header('Location:http://localhost/gaming-php/Views/motdepasse.php?section=changemdp');

       } else {
        
          $erreur = "Code invalide";
          header("Location: ../Views/motdepasse.php?section=code?error=$erreur");
       }

    } else {
     
       $erreur = "Veuillez entrer votre code de confirmation";
       header("Location: ../Views/motdepasse.php?section=code?error=$erreur");
    }
 }

 if(isset($_POST['change_submit'])) {

    if(isset($_POST['change_mdp'],$_POST['change_mdpc'])) {

       $verif_confirme = $bdd->prepare('SELECT confirme FROM recuperation WHERE mail = ?');
       $verif_confirme->execute(array($_SESSION['recup_mail']));
       $verif_confirme = $verif_confirme->fetch();
       $verif_confirme = $verif_confirme['confirme'];

       if($verif_confirme == 1) {

          $mdp = htmlspecialchars($_POST['change_mdp']);
          $mdpc = htmlspecialchars($_POST['change_mdpc']);

          if(!empty($mdp) AND !empty($mdpc)) {

             if($mdp == $mdpc) {
                $mdp = password_hash($mdp, PASSWORD_DEFAULT);

                $ins_mdp = $bdd->prepare('UPDATE users SET password_user = ? WHERE mail = ?');
                $ins_mdp->execute(array($mdp,$_SESSION['recup_mail']));

                $del_req = $bdd->prepare('DELETE FROM recuperation WHERE mail = ?');
                $del_req->execute(array($_SESSION['recup_mail']));
                header('Location:http://localhost/gaming-php/Views/connexion.php');

             } else {
               
                $erreur = "Vos mots de passes ne correspondent pas";
                header("Location: ../Views/motdepasse.php?section=changemdp?error=$erreur");
             }
          } else {
           
             $erreur = "Veuillez remplir tous les champs";
             header("Location: ../Views/motdepasse.php?section=changemdp?error=$erreur");
          }
       } else {
       
          $erreur = "Veuillez valider votre mail grâce au code de vérification qui vous a été envoyé par mail";
          header("Location: ../Views/motdepasse.php?section=changemdp?error=$erreur");
       }
    } else {
      
       $erreur = "Veuillez remplir tous les champs";
       header("Location: ../Views/motdepasse.php?section=changemdp?error=$erreur");
    }
 }

 ?>