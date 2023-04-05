// on prépare l'appel des fonctions dans la page panier.php
$( document ).ready(function() { 
  remplissage('panier', id_session);
  footer('panier');
});

// on récupere l'id du produit et la page concerné grâce la fonction addPanier
function addPanier(id_prod , page ) {
    switch (page){
      case 'index' :
        panierActionUrl = "./Models/panier_action.php?id_prod=";
        break;
      case 'boutique' :
        panierActionUrl = "../Models/panier_action.php?id_prod=";
        break;
      case 'produit' :
        panierActionUrl = "../Models/panier_action.php?id_prod=";
        break;
    }
    $.ajax({
        url: panierActionUrl + id_prod,
        dataType: "json",
        success: function (result) {

        },
        error: function (result) {
  
        }
      });
}
// on supprime l'élément du panier à partir de l'id de la table panier
function removeProduct(id_panier){
  
    $.ajax({
      url: "../Models/delete_panier.php?id_panier=" + id_panier,
      contentType: "application/json; charset=utf-8",
      success: function (result) {
       window.location.replace("./panier.php");
      },
      error: function (result) {
    
      }
  });
}

function modifQuantite(id_panier, quantite){
  $.ajax({
    url: "../Models/modif_quantite_action.php?id_panier=" + id_panier + '&quantite=' + quantite,
    contentType: "application/json; charset=utf-8",
    success: function (result) {
     window.location.replace("./panier.php");
    },
    error: function (result) {
  
    }
});


}