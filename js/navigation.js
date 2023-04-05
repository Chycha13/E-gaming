function remplissage(mode, id_session) {
            navUrl = "./modal_navigation.php";

    switch(mode){
        case 'index':
            navUrl = "./Views/modal_navigation.php";
            break; 
    }
    $.ajax({
    url: navUrl + '?mode=' + mode + "&idSession=" + id_session,
    contentType: "application/json; charset=utf-8",
    success: function (result) {
       $('#navigation').html(result);

    },
    error: function (result) {
      console.log(result);
    }
  });
} 