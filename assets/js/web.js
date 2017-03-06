$(document).ready(function(){
    $('body').on("click", ".login-signup-link", function(){
        $('#loginbox').hide();
        $('#signupbox').fadeIn({duration : 500, queue : false});
    });
    
    $('body').on("click", ".signin-link", function(){
        $('#signupbox').hide();
        $('#loginbox').fadeIn({duration : 500, queue : false});
    });
});