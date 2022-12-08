$(document).ready(function() {
    $("form").submit(function(event) {
        let datas = getFormData("form_sign");
        if(new Date(document.getElementById("nascita").value) >= new Date()){
            addAlert("alert","alert-danger","Data nascita errata!","");
        } else {
            let password = document.createElement("input");
            // Aggiungi un nuovo elemento al tuo form.
            document.getElementById("form_sign").appendChild(password);
            password.name = "password";
            password.type = "hidden"
            password.value = CryptoJS.MD5(document.getElementById("pwd").value).toString();
            datas = getFormData("form_sign");
            $.ajax({
                type: "POST",
                url: "../templates/main_signup/signup_api.php",
                data:  datas,
                processData: false,
                contentType: false
            })
            .done(function(data,success,response) {
                if(data["state"]===false){
                    addAlert("alert","alert-danger",data["msg"],"");
                } else {
                    window.location.href="login.php?iscr=1";
                }
            })
            .fail(function(response) {
                console.log(response);
            });
        }
        event.preventDefault();
    });
});