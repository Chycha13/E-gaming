<?php

    require_once "../config/bdd.php";
    require_once "../bibliotheque/constante_bdd.php";
   
    // création d'un id de session unique
    if(!isset($_GET['idSession']) || $_GET['idSession'] == ''){
        $_GET['idSession'] = "";
    }
   // on récupère la session d'un utilisateur inscrits ou non pour permettre l'utilisation du panier
    $recup_role = $bdd->prepare(GET_SESSION);
    $recup_role->execute(array($_GET['idSession']));
    $role = $recup_role->fetch();   
    
?> 


        <div class="Slogan">
            <p>L'antre des Gamers</p>
        </div>
        <?php
         if(isset($_GET['mode']) && $_GET['mode'] == 'index'){
        ?>
        <div class="navMobile"  id="navMobile">
            <img src="./asset/img/burger.png"  width="100%" alt="IMAGE MENU BURGER">
        </div>
        <?php
         }else{
            if(isset($_GET['mode']) && $_GET['mode'] != 'index'){
         ?>
            <div class="navMobile"  id="navMobile">
            <img src="../asset/img/burger.png"  width="100%" alt="IMAGE MENU BURGER">
        </div>
         <?php
            }   
         }
        ?>
        <div class="navigation">
        <?php      
            if(isset($_GET['mode']) && $_GET['mode'] != 'index'){
        ?>
            <a href="../index.php"><span> Accueil </span></a> 
        <?php   
        }
        ?>
        <?php      
            if(isset($_GET['mode']) && $_GET['mode'] != 'boutique' && $_GET['mode'] != 'index'){
        ?>
            <a href="./boutique.php"><span> Boutique </span></a>
            <?php
            }else{
                if(isset($_GET['mode']) && $_GET['mode'] == 'index'){
            ?>
            <a href="./Views/boutique.php"><span> Boutique </span></a>
            <?php
                }
            }
                
                    if (!empty ($role['role'])){
                        if(isset($_GET['mode']) && $_GET['mode'] == 'index'){
            ?>
                        <a href="./Views/profil.php"><span> compte </span></a>
            <?php
                        }else{
                            if(isset($_GET['mode']) && $_GET['mode'] != 'index'){
            ?>
                                 <a href="./profil.php"><span> compte </span></a>
            <?php
                            }
                        }
                    }else{
                        if(isset($_GET['mode']) && $_GET['mode'] == 'index'){
            ?>         
                        <a href="./Views/connexion.php"><span> Compte </span></a>
            <?php
                    }else{
                        if(isset($_GET['mode']) && $_GET['mode'] != 'index'){
            ?>
                            <a href="./connexion.php"><span> Compte </span></a>
            <?php
                        }
                    }
                }
                if(isset($_GET['mode']) && $_GET['mode'] != 'panier' && $_GET['mode'] != 'index'){
            ?>
                        <a href="./panier.php"><span>Panier</span></a>
            <?php
                }else{
                    if(isset($_GET['mode']) && $_GET['mode'] == 'index'){
            ?>
                        <a href="./Views/panier.php"><span> Panier </span></a>
            <?php
                    }
                }  
                    if(!empty($role['role'])){
                        if(isset($_GET['mode']) && $_GET['mode'] != 'index'){
            ?>
                        <a href="../Models/deconnexion.php"><span> Déconnexion </span></a>
            <?php
                    }else{
                        if(isset($_GET['mode']) && $_GET['mode'] == 'index'){
            ?>
                        <a href="./Models/deconnexion.php"><span> Déconnexion </span></a>
            <?php
                    }
                }
            }
            ?>                        
            </div>
            <script type="text/javascript">$( document ).ready(function() { 
                openBurger();
    });  
    </script>
      