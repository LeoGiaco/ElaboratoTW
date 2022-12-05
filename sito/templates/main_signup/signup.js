$(document).ready(function() {
    $("#button").click(function() {
        const datas = getFormData("form_sign");
        if(new Date(datas.nascita) >= new Date()){
            addAlert("alert","alert-danger","Data nascita errata!","");
            return;
        }
        $.ajax({
            type: "POST",
            url: "../templates/main_signup/signup_api.php",
            data:  datas
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
    });
});