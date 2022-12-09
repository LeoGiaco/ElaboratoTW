const fileint = "../templates/main_posts/posts_api.php";

$(document).ready(function() {
    select_file(fileint, "datiTipologie", "slcGenere", "", "");
    
    $("#btnCancella").click(function(){
        svuota();
    });

    $("#btnAggiungi").click(function(){
        const datas = getFormData("formPost");
        let file = $("#image")[0].files[0];
        if(file===undefined)
            file = "";
        datas.append("file",file);
        datas.append("request","nuovoPost");
        console.log(datas.get("titolo"));
        if(datas.get("titolo") === "" || datas.get("testo") === ""){
            addAlert("alert","alert-danger", "Completare i campi del post","");
        } else {
            $.ajax({
                type: "POST",
                url: fileint,
                data:  datas, 
                processData: false,
                contentType: false
            })
            .done(function(data,success,response) {
                console.log(data);
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
        }
    });
});

function svuota(){
    $("#formPost")[0].reset();
}