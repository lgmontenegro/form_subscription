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

function passStrength(){
    var passwd = $('#inputPass').val();
    var strength = 0;
    var checkCharactersMinus = 0;
    var checkCharactersMajor = 0;
    var checkNumbers = 0;
    var checkSpecial = 0;
    
    $('#helpWeak').addClass("hidden");
    $('#helpOk').addClass("hidden");
    $('#helpStrong').addClass("hidden");
    
    $('#passwordGroup').removeClass("has-error");
    $('#passwordGroup').removeClass("has-warning");
    $('#passwordGroup').removeClass("has-success");
    
    if(passwd.length < 5){
        $('#passwordGroup').addClass("has-error");
        $('#helpWeak').removeClass("hidden");
        return false;
    }else{
        
        checkCharactersMinus = passwd.match(/[a-z]+/);
        checkCharactersMajor = passwd.match(/[A-Z]+/);
        checkNumbers = passwd.match(/[0-9]+/);
        checkSpecial = passwd.match(/[\W]+/);
        
        var minus = 0;
        var major = 0;
        
        if(checkCharactersMinus !== null){
            var minus = checkCharactersMinus[0].length;
        }
        
        if(checkCharactersMajor !== null){
            var major = checkCharactersMajor[0].length;
        }
        
        if((minus + major) === 0){
            $('#passwordGroup').addClass("has-error");
            $('#helpWeak').removeClass("hidden");
            return false;
        }else{
            strength += (minus + major);
        }
        
        if(checkNumbers !== null){
            strength += checkNumbers[0].length;
        }else{
            $('#passwordGroup').addClass("has-error");
            $('#helpWeak').removeClass("hidden");
            return false;
        }
        
        if(checkSpecial !== null){
            strength += checkSpecial[0].length + 2;
        }
        
        if(strength < 8){
            $('#passwordGroup').addClass("has-warning");
            $('#helpOk').removeClass("hidden");
            return true;
        }else if(strength >=8 ){
            $('#passwordGroup').addClass("has-success");
            $('#helpStrong').removeClass("hidden");
            return true;
        }
    }
    
}

function checkPasswordEqual(){
    var passwordOne = $('#inputPass').val();
    var passwordTwo = $('#inputConfirmarPass').val();
    
    $('#helpConfirmaPasswordError').addClass("hidden");
    $('#helpConfirmaPasswordOk').removeClass("hidden");
    
    $('#confirmarPasswordGroup').removeClass("has-error");
    $('#confirmarPasswordGroup').removeClass("has-success");
    
    if(passwordOne === passwordTwo){
        $('#confirmarPasswordGroup').addClass("has-success");
        $('#helpConfirmaPasswordOk').removeClass("hidden");
        return true;
    }else{
        $('#confirmarPasswordGroup').addClass("has-error");
        $('#helpConfirmaPasswordError').removeClass("hidden");
        return false;
    }
}

function submitForm(){
    var envia = isValidEmailFormat();
    var confirmEmail = $('#inputConfirmarEmail').val();
    if(confirmEmail.length === 0){
        envia = false;
    }else{
        envia = isEqualEmail();
    }
    if(!envia){
        window.alert('Verifique e corrija os problemas com os campos de email!');
        return false;
    }
    
    envia = passStrength();
    var confirmPassword = $('#inputConfirmarPass').val();
    if(confirmPassword.length === 0){
        envia = false;
    }else{
        envia = checkPasswordEqual();
    }
    
    if(!envia){
        window.alert('Verifique e corrija os problemas com os campos de senha!');
        return false;
    }
    
    var nome = $('#inputNome').val();
    var apelido = $('#inputApelido').val();
    var rua = $('#inputRua').val();
    var codigoPostal = $('#inputCodigoPostal').val();
    var localidade = $('#inputLocalidade').val();
    var nif = $('#inputNIF').val();
    var telefone = $('#inputTelefone').val();
    
    if(nome.length === 0){
        $('#gNome').addClass('has-error');
        envia = false;
    }
    if(apelido.length === 0){
        $('#gApelido').addClass('has-error');
        envia = false;
    }
    if(rua.length === 0){
        $('#gRua').addClass('has-error');
        envia = false;
    }
    if(codigoPostal.length === 0){
        $('#gCodigo').addClass('has-error');
        envia = false;
    }
    if(localidade.length === 0){
        $('#gLocalidade').addClass('has-error');
        envia = false;
    }
    if(nif.length === 0){
        $('#gNIF').addClass('has-error');
        envia = false;
    }
    if(telefone.length === 0){
        $('#gTelefone').addClass('has-error');
        envia = false;
    }
    
    if(!envia){
        window.alert('Todos os campos são obrigatórios! Por favor, volte e preencha os campos marcados em vermelho!');
        return false;
    }
    
    if(envia){
        console.log('passou');
        
            var url = "register.php"; 
            $.ajax({
                   type: "POST",
                   url: url,
                   data: $("#registration").serialize(), 
                   success: function(data)
                   {
                       alert(data); 
                   }
                 });
            
        
    }
    return true;
}



//$("#registration").submit(function(e) {
//
//    var url = "register.php"; // the script where you handle the form input.
//
//    $.ajax({
//           type: "POST",
//           url: url,
//           data: $("#registration").serialize(), // serializes the form's elements.
//           success: function(data)
//           {
//               alert(data); // show response from the php script.
//           }
//         });
//
//    e.preventDefault(); // avoid to execute the actual submit of the form.
//});