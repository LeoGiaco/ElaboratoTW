$(document).ready(function() {
    $("form").submit(function(event) {
        const datas = getFormData("form_sign");
        console.log(datas);
        if(new Date(datas.nascita) >= new Date()){
            addAlert("alert","alert-danger","Data nascita errata!","");
        } else {
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