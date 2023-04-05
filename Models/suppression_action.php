<?php
require_once "../config/bdd.php";

 if(isset($_GET['Delete']))  {
        
        $recupUser = $bdd->prepare('SELECT * FROM users WHERE id_user = ?');
        $recupUser->execute(array($_GET['Delete']));
        
        // rowCount check if row in the table are higher to 0
        if($recupUser->rowCount() > 0)
        {
            $bannirUser = $bdd->prepare('DELETE FROM users WHERE id_user = ?');
            $bannirUser->execute(array($_GET['Delete']));

            header('Location: ../Views/admin.php');
        }
            else{
                $erreur = "Aucun membre n'a été trouvé";
                header('Location: ../Views/admin.php?error=$erreur');
            }
    }
            else
            {
                $erreur = "Identifiant n'a pas été récupéré";
                header('Location: ../Views/admin.php?error=$erreur');
  }

  if(isset($_GET['Delete']))  {
        
    $recupUser = $bdd->prepare('SELECT * FROM produits WHERE id_prod = ?');
    $recupUser->execute(array($_GET['Delete']));
    
    // rowCount check if row in the table are higher to 0
    if($recupUser->rowCount() > 0)
    {
        $bannirUser = $bdd->prepare('DELETE FROM produits WHERE id_prod = ?');
        $bannirUser->execute(array($_GET['Delete']));

        header('Location: ../Views/admin.php');
    }
        else{
            $erreur = "Aucun produit n'a été trouvé";
            header('Location: ../Views/admin.php?error=$erreur');
        }
}
        else
        {
            $erreur ="Identifiant n'a pas été récupéré";
            header('Location: ../Views/admin.php?error=$erreur');
}


