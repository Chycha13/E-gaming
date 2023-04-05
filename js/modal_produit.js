

$("#pop").click(function() {
    bln_ok = true;
    tab_message = [];
   

    var donneesFormulaire = new FormData($("#formProd").get(0));

    if (bln_ok) {
      $.ajax({
        url: "../Models/produits_action.php",
        type:'post',
        contentType: false,
        processData: false,
        dataType: "json",
        data: donneesFormulaire ,
        success: function (result) {
          
          if (!result.bln_ok) {
            event.preventDefault();

            //on affiche les erreurs
            str_messageErreur = "";
            for (message of result.tab_message) {
              if (str_messageErreur == "") {
                str_messageErreur += message;
              }
              else {
                str_messageErreur += "<br>" + message;
              }
            }

            $("#libelle_erreur").html(str_messageErreur);
            $('#popupErreur').css('display', 'block');

          } else {
            
            $("#libelle_succes").html("Produit ajouté avec succès. ");
            $('#popupSucces').css('display','block');
            
            $('#popupErreur').css('display', 'none');
          //   $('#popUp').css('display', 'none');
          //   location.reload();
          }
        },
        error: function (result) {
          
          // retour = JSON.parse(result);
          console.log(result);
          bln_ok = false;
        }
      });

    }   
    return false;
  });

$("#close_modal").click(function () {
    $('#popupErreur').css('display', 'none');
    
  });
  $("#close_modal2").click(function () {
   location.reload();
    
  });
  

  window.onclick = function (event) {
    if (event.target == document.getElementById("popupErreur")) {
      document.getElementById("popupErreur").style.display = "none";
    }
    if (event.target == document.getElementById("popupSucces")) {
     location.reload();
    }
  }

