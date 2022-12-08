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
            if(data["state"]===false){
                addAlert("alert","alert-danger",data["msg"],"");
            } else {
                addAlert("alert","alert-success","Post inserito!","");
                svuota();
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