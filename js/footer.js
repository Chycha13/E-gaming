function footer(mode) {
    navUrl = "./modal_footer.php";

switch(mode){
case 'index':
    navUrl = "./Views/modal_footer.php";
    break; 
}
$.ajax({
url: navUrl + '?mode=' + mode,
contentType: "application/json; charset=utf-8",
success: function (result) {
$('#foot').html(result);

},
error: function (result) {
console.log(result);
}
});
} 