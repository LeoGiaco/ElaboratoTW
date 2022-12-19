$(document).ready(function() {
    if($("#login").val()==1){
        addAlert("alert","alert-success","Iscrizione completata! Eseguire l'accesso.","");
    }

    $("#form_login").submit(function(event) {
        let datas = getFormData("form_login");
        datas.append("password", CryptoJS.MD5(datas.get("pwd")).toString());
        datas.delete("pwd");
        $.ajax({
            type: "POST",
            url: "templates/main_login/login_api.php",
            data:  datas,
            processData: false,
            contentType: false
        })
        .done(function(data,success,response) {
            if(data["state"]===false){
                addAlert("alert","alert-danger",data["msg"],"");
            } else {
                window.location.href="pages/homepage.php";
            }
        })
        .fail(function(response) {
            console.log(response);
        });
        event.preventDefault();
    });

    $("#btnIscriviti").click(function() {
        window.location.href="signup.php";
    });


});