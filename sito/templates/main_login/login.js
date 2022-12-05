$(document).ready(function() {
    if($("#login").val()==1){
        addAlert("alert","alert-success","Iscrizione completata! Eseguire l'accesso.","");
    }
    $("#button").click(function() {
        const datas = getFormData("form_login");
        $.ajax({
            type: "POST",
            url: "../templates/main_login/login_api.php",
            data:  datas
        })
        .done(function(data,success,response) {
            console.log(data);
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
});