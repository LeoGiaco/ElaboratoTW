const fileint = "../templates/main_posts/posts_api.php";

$(document).ready(function() {

    $("#btnTop").css({
        position: "fixed",
        bottom: "20px",
        right: "20px",
        zIndex: 1
    });

    $("#btnTop").click(function() {
        $("html, body").animate({ scrollTop: 0 }, "slow");
        return false;
    });

      

    $("#divCommento").hide();
    select_file(fileint, "datiTipologie", "slcGenere", "", "");
    
    $("#btnCancella").click(function(){
        svuota();
    });

    $("#btnCommento").click(function(){
        $("#divCommento").toggle();
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