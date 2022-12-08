const fileint = "../templates/main_posts/posts_api.php";

$(document).ready(function() {
    select_file(fileint, "datiTipologie", "", "slcGenere", "", "");
    
    $("#btnCancella").click(function(){
        svuota();
    });

    $("#btnAggiungi").click(function(){
        datas = getFormData("formPost");
        file = $("#image")[0].files[0];
        datas.append("file",file);
        
        $.ajax({
            type: "POST",
            url: fileint,
            data:  datas, 
            processData: false,
            contentType: false
        })
        .done(function(data,success,response) {
            console.log(data);
            // if(data["state"]===false){
            //     alert("Errore");
            //     // addAlert("alert","alert-danger",data["msg"],"");
            // } else {
            //     alert("Avvenuto con successo");
            //     svuota();
            // }
        })
        .fail(function(response) {
            console.log(response);
        });
    });
});

function svuota(){
    $("#formPost")[0].reset();
}