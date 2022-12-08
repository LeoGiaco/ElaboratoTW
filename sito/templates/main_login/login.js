$(document).ready(function() {
    if($("#login").val()==1){
        addAlert("alert","alert-success","Iscrizione completata! Eseguire l'accesso.","");
    }

    $("#btnAccedi").click(function(event) {
        let password = document.createElement("input");
        // Aggiungi un nuovo elemento al tuo form.
        document.getElementById("form_login").appendChild(password);
        password.name = "password";
        password.type = "hidden"
        password.value = CryptoJS.MD5( document.getElementById("pwd").value).toString();
        let datas = getFormData("form_login");
        $.ajax({
            type: "POST",
            url: "../templates/main_login/login_api.php",
            data:  datas,
            processData: false,
            contentType: false
        })
        .done(function(data,success,response) {
            if(data["state"]===false){
                addAlert("alert","alert-danger",data["msg"],"");
            } else {
                window.location.href="homepage.php";
            }
        })
        .fail(function(response) {
            console.log(response);
        });
    });

    $("#btnIscriviti").click(function() {
        window.location.href="signup.php";
    });


});