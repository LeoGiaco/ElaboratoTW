const fileint = "../templates/main_posts/posts_api.php";
// Variabile globale per il conteggio dei post.
let postsLoaded = 0;

$(document).ready(function() {
    select_file(fileint, "datiTipologie", "slcGenere", "", "");

    const datas = new FormData(); 
    datas.append("request", "getUserInfo");
    $.ajax({
        type: "POST",
        url: fileint,
        data:  datas, 
        processData: false,
        contentType: false
    })
    .done(function(data,success,response) {
        $("#userImage").attr("src", "../../img/profile_img/"+data["dati"][0]["Immagine"]);
    })
    .fail(function(response) {
        console.log(response);
    });
    
    visualizzaPost(postsLoaded, false, "", false);
    postsLoaded += 5;
    window.onscroll = function() {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight-5) {
            visualizzaPost(postsLoaded, false, "", $("#allPost").is(":checked"));
            postsLoaded += 5;
        }
    };

    $("#btnTop").click(function() {
        $("html, body").animate({ scrollTop: 0 }, "slow");
    });

    $("#btnCancella").click(function(){
        svuota();
    });

    $("#btnAggiungi").click(function(){
        addAlert("alert","alert-warning","Caricamento post in corso!","");
        aggiungiPost();
    });

    $("#contPosts").on("click",'button',function(){
        gestioneBottoni($(this));
    });

    $("#allPost").change(function() {
        if($(this).is(":checked")){
            postsLoaded=0;
            visualizzaPost(postsLoaded, true, "", true);
            postsLoaded+=5;
        } else {
            postsLoaded=0;
            visualizzaPost(postsLoaded, true, "", false);
            postsLoaded+=5;
        }
    });

});

function svuota(){
    $("#formPost")[0].reset();
}

function aggiungiPost(){
    const datas = getFormData("formPost");
    let file = $("#image")[0].files[0];
    if(file===undefined)
        file = "";
    datas.append("file",file);
    datas.append("request","nuovoPost");
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
            if(data["state"]===false){
                addAlert("alert","alert-danger",data["msg"],"");
            } else {
                addAlert("alert","alert-success","Post inserito!","");
                svuota();
            }
            postsLoaded=0;
            visualizzaPost(postsLoaded, true, "", $("#allPost").is(":checked"));
            console.log($("#allPost").is(":checked"));
            postsLoaded += 5;
        })
        .fail(function(response) {
            console.log(response);
        });
    }
}