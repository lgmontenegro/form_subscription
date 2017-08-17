function isValidEmailFormat(){
    var email = $('#inputEmail').val();
    var validation = email.match(/^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/);
    
    if (validation === null) {
        $('#emailGroup').addClass("has-error");
        $('#emailGroup').removeClass("has-success");
        $('#helpEmail').removeClass("hidden");
        return false;
    } else {
        $('#emailGroup').removeClass("has-error");
        $('#emailGroup').addClass("has-success");
        $('#helpEmail').addClass("hidden");
        return true;
    }
    return true;
}

function isEqualEmail(){
    var email = $('#inputEmail').val();
    var confirmEmail = $('#inputConfirmarEmail').val();
    
    if(email === confirmEmail){
        $('#confirmEmailGroup').removeClass("has-error");
        $('#confirmEmailGroup').addClass("has-success");
        $('#helpConfirmEmail').addClass("hidden");
        return true;
    }else{
        $('#confirmEmailGroup').addClass("has-error");
        $('#confirmEmailGroup').removeClass("has-success");
        $('#helpConfirmEmail').removeClass("hidden");
        return false;
    }
}