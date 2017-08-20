jQuery(function($){
   $("#inputNIF").mask("999999999");
   $('#inputCodigoPostal').mask("****-***");
   $('#inputTelefone').mask('99 999 9999');
});

function portugalPhoneNumber(){
    var country = $('#inputPais').val();
    if(country === 'Portugal'){
       $('#inputTelefone').mask('99 999 9999');
    }else{
        $('#inputTelefone').unmask();
        $('#inputTelefone').mask('9999999999999');
    }
}