const fileint = "../templates/main_posts/posts_api.php";

$(document).ready(function() {
    select_file(fileint, "datiTipologie", "", "slcGenere", "", "");
    
    $("#btnCancella").click(function(){
        svuota();
    });

    $("#btnAggiungi").click(function(){
        const datas = getFormData("formPost");
        console.log(datas);
        $.ajax({
            type: "POST",
            url: fileint,
            data:  datas
        })
        .done(function(data,success,response) {
            if(data["state"]===false){
                alert("Errore");
                // addAlert("alert","alert-danger",data["msg"],"");
            } else {
                alert("Avvenuto con successo");
            }
        })
        .fail(function(response) {
            console.log(response);
        });
    });
});

function svuota(){
    $("#formPost")[0].reset();
}