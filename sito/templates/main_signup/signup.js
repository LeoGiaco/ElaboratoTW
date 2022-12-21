const fileint = "templates/main_signup/signup_api.php";
$(document).ready(function() {
    setInterests();
    
    $("form").submit(function(event) {
        const datas = getFormData("form_sign");
        datas.append("request", "aggiungiUtente");
        for (const value of datas.keys()) {
            console.log(value);
          }
        if(new Date(datas.get("nascita")) >= new Date()){
            addAlert("alert","alert-danger","Data nascita errata!","");
        } else {
            datas.append("password", CryptoJS.MD5(datas.get("pwd")).toString());
            datas.delete("pwd");
            $.ajax({
                type: "POST",
                url: "templates/main_signup/signup_api.php",
                data:  datas,
                processData: false,
                contentType: false
            })
            .done(function(data,success,response) {
                if(data["state"]===false){
                    console.log(data);
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

    $("#btnLogin").click(function() {
        window.location.href="login.php";
    });
});