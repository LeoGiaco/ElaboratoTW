const fileint = "../templates/main_signup/signup_api.php";
$(document).ready(function() {
    setInterests();
    
    $("form").submit(function(event) {
        event.preventDefault();
        const datas = getFormData("form_sign");
        datas.append("request", "aggiungiUtente");
        for (const value of datas.keys()) {
            console.log(value);
          }
        // const arr = Array();
        // $("input:checkbox[name=interessi]:checked").each(function(){
        //     arr.push($(this).val());
        // });
        // datas.append("interessi", arr);
        if(new Date(datas.get("nascita")) >= new Date()){
            addAlert("alert","alert-danger","Data nascita errata!","");
        } else {
            datas.append("password", CryptoJS.MD5(datas.get("pwd")).toString());
            datas.delete("pwd");
            $.ajax({
                type: "POST",
                url: "../templates/main_signup/signup_api.php",
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
    });
});

function setInterests(){
    const formdata = new FormData();
    formdata.append("request", "interessiPossibili");
    $.ajax({
        type: "POST",
        url: "../templates/main_signup/signup_api.php",
        data:  formdata,
        processData: false,
        contentType: false
    })
    .done(function(data,success,response) {
        const dati = data.dati;
        for(let i=0; i<dati.length; i++){
            $("#intset").append('<label for="'+dati[i]["Nome"]+'" class="mb-1"><input id="'+dati[i]["Nome"]+'" class="mx-1" type="checkbox" value="'+dati[i]["Nome"]+'" name="'+dati[i]["Nome"]+'"/>'+dati[i]["Nome"]+'</label>')
        }
    })
    .fail(function(response) {
        console.log(response);
    });    
}