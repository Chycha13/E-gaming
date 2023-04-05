<?php
require_once "../config/bdd.php";
require_once "../bibliotheque/constante_bdd.php";

$bln_ok = true;
$tab_messageErreur = array();

if(isset($_POST['id_produit']) && isset($_POST['nom_prod']) && isset($_POST['desc_prod']) && isset($_POST['prix_prod']) && isset($_POST['nom_cat']) && isset($_FILES['photo_prod'])){
    $id_prod = htmlspecialchars($_POST['id_produit']);
    $nom_prod = htmlspecialchars($_POST['nom_prod']);
    $desc_prod = htmlspecialchars($_POST['desc_prod']);
    $prix_prod = htmlspecialchars($_POST['prix_prod']);
    $nom_cat = htmlspecialchars($_POST['nom_cat']);
    $photo_prod = htmlspecialchars($_POST['hidden_photo']);

    
    if(isset($_FILES['photo_prod']) && !empty($_FILES['photo_prod']['name'])){
     
        $tailleMax = 2097152;
        $extensionsValide = array('jpg','jpeg', 'gif', 'png');
    
        if($_FILES['photo_prod']['error'] == 0){
         
            //we use strtolower for all string in minuscule , strrchr for use only extension after '.' and substr for ignore the first character (whith entry '1')
            $extensionUpload = strtolower(substr(strrchr($_FILES['photo_prod']['name'], '.'),1));
    
                if(in_array($extensionUpload, $extensionsValide)){
                  
                    $chemin = "../asset/img/".$_FILES['photo_prod']['name'].".".$extensionUpload;
                    $resultat = move_uploaded_file(($_FILES['photo_prod']['tmp_name']), $chemin);
                                       
                    if($resultat){
                        
                        $photo_prod = $_FILES['photo_prod']['name'].".".$extensionUpload;
                            
                    }else{
                        $bln_ok = false;
                        $tab_messageErreur[] = "erreur durant l'importation de l'image.";
                    }
                }            
        }else{ 
            $bln_ok = false; 
            $tab_messageErreur[] = "Votre image produit dois être inférieur à 2Mo ou bien l'image dois être au format jpg, jpeg , gif ou png. .";
        }
    }

    if(!empty($nom_prod) && !empty($desc_prod) && !empty($prix_prod) && !empty($nom_cat) && !empty($photo_prod)){

        if($id_prod != ''){
            $ajouter_produit = $bdd->prepare(MODIF_PRODUIT);
            $ajouter_produit->execute(array($nom_prod, $desc_prod, $prix_prod, $photo_prod, $nom_cat, $id_prod));
        }else{
            $ajouter_produit = $bdd->prepare(INSERTION_PRODUIT);
            $ajouter_produit->execute(array($nom_prod, $desc_prod, $prix_prod, $photo_prod, $nom_cat));
        }
    }else{
        $bln_ok = false;
        $tab_messageErreur[] = "Veuillez remplir tout les champs.";
    }
     
}else{
    $bln_ok = false;
    $tab_messageErreur[] = "Erreur lors de la vérification des données.";
}

$tab_retourJson = array();
$tab_retourJson["bln_ok"] = $bln_ok;  
$tab_retourJson['tab_message']= $tab_messageErreur;
        
$json = json_encode($tab_retourJson); // transforme en notation JSON les données $datas => le tableau php (array)
echo $json; //retourne au client (Unity, Godot Engine...) les données sous forme d'objet JSON