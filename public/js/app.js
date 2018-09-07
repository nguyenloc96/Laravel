$(document).ready(function(){
    $('#navbarNav .nav-item').on('click', function(){
        $('#navbarNav .nav-item').removeClass('active');
        $(this).addClass('active');
    });
});