<?php
require_once "../config/bdd.php";
require_once "../bibliotheque/constante_bdd.php";

$nom = '';
$desc = '';
$prix = '';
$categorie = '';
$photo = '';

if($_GET['mode'] == 'modif'){

    $recup_produit = $bdd->prepare(SELECT_PROD);
    $produit = $recup_produit->execute(array($_GET['id']));
    $produit = $recup_produit->fetch();
    
    $nom = $produit['nom_prod'];
    $desc = $produit['desc_prod'];
    $prix = $produit['prix_prod'];
    $categorie = $produit['id_categorie'];
    $photo = $produit['photo_prod'];
}


?>

<script src="../js/modal_produit.js"></script>

<div class="containerPopup2">
    <button type="submit" class="closeStyle2" onClick="closeModal()">
        <img src="../asset/img/pngwing.com.png" class="cross" width="25px" alt="Croix de fermeture fenêtre">
    </button>

    <form class="FormPopup" id="formProd" method="POST">
        <input type="hidden" name="id_produit" id="id_produit" value="<?=$_GET['id']?>">
        <input type="hidden" name="hidden_photo" id="hidden_photo" value="<?=$photo?>">
        <table class="table">
            <tr>
                <td>
                    <label for="nom_prod" class="labelStyle2">Nom du produit :</label>
                    <input class="outline" type="text" value="<?= $nom ?>" id="nom_prod" name="nom_prod" autocomplete="off">
                    <br><br>
                </td>
            </tr>

            <tr>
                <td>
                    <label for="desc_prod" class="labelStyle2">Description du produit :</label>
                    <textarea name="desc_prod" class="desc_prod" cols="45" rows="5"><?= $desc; ?></textarea>
                    <br><br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="prix_prod" class="labelStyle2">Prix du produit :</label>
                    <input class="outline" type="text" value="<?= $prix; ?>" id="prix_prod" name="prix_prod" autocomplete="off">
                    <br><br>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="nom_cat">Catégorie :</label>
                    <select class="select" name="nom_cat" id="">
                        <?php
                        $recup_cat = $bdd->query(SELECT_CAT);
                        while ($cat = $recup_cat->fetch()) {
                            if($categorie == $cat['id_categorie']){
                                $selected = 'selected';
                            }else{
                                $selected = '';
                            }                           
                        ?>
                            <option value="<?= $cat['id_categorie']?>" <?=$selected?> > <?= $cat['nom_categorie']?></option>

                        <?php                      
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label for="photo_prod" class="labelStyle2">Image du produit :</label>
                    <input class="outline" type="FILE" id="photo_prod" name="photo_prod" value="<?=$photo?>" autocomplete="off">
                    
                    <br><br>
                </td>
            </tr>
            <tr>
                <td>
                    
                </td>
            </tr>
        </table>
    </form>
    <button class="btnConnexion" id="pop">Envoyer</button>
</div>

<div id="popupErreur" class="modalErreur">
    <div class="modal-content">
        <span id="close_modal" class="close_modal">&times;</span>
        <div class="affichage_erreurs">
            <span id="libelle_erreur" name="libelle_erreur"></span>
        </div>
    </div>
</div>

<div id="popupSucces" class="modalErreur">
<div class="modal-content">
        <span id="close_modal2" class="close_modal">&times;</span>
        <div class="affichage_erreurs">
            <span id="libelle_succes"></span>
        </div>
    </div>
</div>