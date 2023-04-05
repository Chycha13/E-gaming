<?php
require_once "../config/bdd.php";
require_once "../bibliotheque/constante_bdd.php";


if(isset($_GET['id_user'])){

    $recup_role = $bdd->prepare(SELECT_ROLE_USER);
    $recup_role->execute(array($_GET['id_user']));
    while($role = $recup_role->fetch()) {
        if(trim($role['role']) == 'user'){
            $switchRole = 'admin' ;    
        }
        else{
            $switchRole = 'user';
        }
    } 
        
    $switch_admin = $bdd->prepare(UPDATE_ROLE_USER);
    $switch_admin->execute(array($switchRole, $_GET['id_user']));
    
    header('Location: ../Views/admin.php');
}