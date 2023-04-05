
function openBurger() {
    $('#navMobile').click(function(e){ 
        e.preventDefault();
        $('body').toggleClass('openMenu');
    })
};
