  /* pop up page admin */
 
  function openModal(id,mode) {
    $.ajax({
    url: "./modal_produit.php?id=" + id + '&mode=' + mode,
    contentType: "application/json; charset=utf-8",
    success: function (result) {
       $('#popUp').html(result);
       $('#popUp').css('display', 'block');
    },
    error: function (result) {
      console.log(result);
    
    }
  });
} 
                            
function closeModal(){
    $('#popUp').css('display', 'none');
}