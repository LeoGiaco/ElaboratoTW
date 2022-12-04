$(document).ready(function() {
    $("#button").click(function() {
        
        let data = getFormData("form_sign");
        $.ajax({
            type: "POST",
            url: "../templates/main_signup/signup_api.php",
            data:  data
        })
        .done(function(data,success,response) {
            console.log(data);
           alert("Inserimento avventuo con succeso");
        })
        .fail(function(response) {
            console.log(response);
        });
    });
});