
/* validate password on register submit */

$('#register-form').submit(function(event){
    if($('[name=password]').val() !== $('[name=confirm-password]').val()){
        event.preventDefault();
        alert("password did not match");
    }
});

