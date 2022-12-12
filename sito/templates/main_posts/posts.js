const fileint = "../templates/main_posts/posts_api.php";

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
    
    visualizzaPost();
    $("#btnTop").click(function() {
        $("html, body").animate({ scrollTop: 0 }, "slow");
    });

    $("#btnCancella").click(function(){
        svuota();
    });

    $("#btnAggiungi").click(function(){
        aggiungiPost();
    });
});

function visualizzaPost(){
    const datas = new FormData();
    datas.append("request", "getPosts")
    $.ajax({
        type: "POST",
        url: fileint,
        data:  datas, 
        processData: false,
        contentType: false
    })
    .done(function(data,success,response) {
        const dati=data["posts"];
        let row = '';
        for(let i=0; i<dati.length; i++){
            const temp=processaLike(dati[i]);
            const like=temp[0];
            const dislike=temp[1];
            row += '<div id="post'+dati[i]["ID"]+'" class="card my-2">';
            row += '<div class="card-body"><div class="d-flex flex-start align-items-center">';
            row += '<img class="rounded-circle shadow-1-strong mr-2 me-2" src="../../img/profile_img/'+dati[i]["Immagine"]+'" alt="avatar user" width="60" height="60" />';
            row += '<div><p class="fw-bold text-primary mb-1 text-left">'+dati[i]["Utente"]+'</p>';
            row += '<p class="text-muted small mb-0">'+dati[i]["Data"]+'</p></div></div>';
            row += '<div><h3 class="mt-3 mb-2 pb-2">'+dati[i]["Titolo"]+'</h3>';
            if(dati[i]["Media"]!==""){
                row += '<div class="text-center"><img src="../../img/post_img/'+dati[i]["Media"]+'" alt="Immagine del post intitolato:'+dati[i]["Titolo"]+'" class="responsive"/></div>';
            }
            row += '<p class="mt-3 mb-2 pb-2">'+dati[i]["Testo"]+'</p>';
            row += '<div class="small d-flex justify-content-start">';
            row += '<button id="btnLike'+dati[i]["ID"]+'" class="d-flex align-items-center me-3 btn btn-outline-success btn-sm" data-type="like" data-numero="'+dati[i]["ID"]+'" >Like: '+like+'</button>';
            row += '<button id="btnDislike'+dati[i]["ID"]+'" class="d-flex align-items-center me-3 btn btn-outline-danger btn-sm" data-type="dislike" data-numero="'+dati[i]["ID"]+'">Dislike: '+dislike+'</button>';
            row += '<button class="d-flex align-items-center me-3 btn btn-outline-primary btn-sm" data-type="commento" data-numero="'+dati[i]["ID"]+'">Commento</button></div></div>';
            row += '</div>';
            // Sezione commenti
            row += '<div class="card-footer py-3 border-0" id="divCommento'+dati[i]["ID"]+'">';
            row += '<div id="contComment'+dati[i]["ID"]+'"></div>';
            row += '<div class="d-flex flex-start w-100">';
            row += '<form id="comS'+dati[i]["ID"]+'" class="form-outline w-100">';
            row += '<label class="form-label" for="inpCommento'+dati[i]["ID"]+'">Commento: </label>';
            row += '<input class="form-control" id="inpCommento'+dati[i]["ID"]+'" name="testo" placeholder="Inserisci il testo del commento"/></form></div>';
            row += '<div class="float-end mt-2 pt-1"><button type="button" class="btn btn-primary btn-sm" data-type="comS" data-numero="'+dati[i]["ID"]+'">Commenta</button>';
            row += '</div></div></div>'; 
        }
        $("#contPosts").html(row);
        $(".card-footer").hide();

        $("form").submit(function(event){
            event.preventDefault();
        });

        $("#sctId button").click(function(event){
            const btn = $(this),
            type = btn.data('type'),
            numero = btn.data('numero');
            switch(type){
                case "commento":
                    $("#divCommento"+numero).toggle();
                    commentiPost(numero);
                    break;
                case "comS":
                    const datas = getFormData("comS"+numero);
                    if(datas.get("testo")!=""){
                        datas.append("request", "aggiungiCommento");
                        datas.append("nPost", numero);
                        $.ajax({
                            type: "POST",
                            url: fileint,
                            data:  datas, 
                            processData: false,
                            contentType: false
                        })
                        .done(function(data,success,response) {
                            $("#inpCommento"+numero).val("");
                            commentiPost(numero);
                        })
                        .fail(function(response) {
                            console.log(response);
                        });
                    }
                    break;
                case "like":
                    const like = new FormData();
                    like.append("request", "aggiuniReaction");
                    like.append("nPost", numero);
                    like.append("like", 1);
                    like.append("dislike", 0);
                    like.append("type", "Like");
                    $.ajax({
                        type: "POST",
                        url: fileint,
                        data:  like, 
                        processData: false,
                        contentType: false
                    })
                    .done(function(data,success,response) {
                        const temp=processaLike(data);
                        const like=temp[0];
                        const dislike=temp[1];
                        $("#btnLike"+numero).text("Like: "+like);
                        $("#btnDislike"+numero).text("Dislike: "+dislike);
                    })
                    .fail(function(response) {
                        console.log(response);
                    });
                    break;
                case "dislike":
                    const dislike = new FormData();
                    dislike.append("request", "aggiuniReaction");
                    dislike.append("nPost", numero);
                    dislike.append("like", 0);
                    dislike.append("dislike", 1);
                    dislike.append("type", "Dislike");
                    $.ajax({
                        type: "POST",
                        url: fileint,
                        data:  dislike, 
                        processData: false,
                        contentType: false
                    })
                    .done(function(data,success,response) {
                        const temp=processaLike(data);
                        const like=temp[0];
                        const dislike=temp[1];
                        $("#btnLike"+numero).text("Like: "+like);
                        $("#btnDislike"+numero).text("Dislike: "+dislike);
                    })
                    .fail(function(response) {
                        console.log(response);
                    });
                    break;
            }  
            event.preventDefault();
        });
    })
    .fail(function(response) {
        console.log(response);
    });
}

function svuota(){
    $("#formPost")[0].reset();
}

function processaLike(dati){
    let like;
    let dislike;
    if(dati["reactions"].length===0){
        like=0;
        dislike=0;
    } 
    else{
        like=dati["reactions"][0]["NumLike"];
        dislike=dati["reactions"][0]["NumDislike"];
    }
    return Array(like, dislike);
}

function aggiungiPost(){
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
            visualizzaPost();
        })
        .fail(function(response) {
            console.log(response);
        });
    }
}

function commentiPost(numero){
    const datas = getFormData("formPost");
    datas.append("request", "commentiPost");
    datas.append("idPost", numero);
    $.ajax({
        type: "POST",
        url: fileint,
        data:  datas, 
        processData: false,
        contentType: false
    })
    .done(function(data,success,response) {
        console.log(data);
        let row='';
        data.forEach(element => {
            // Manca la data del commento.
            row += '<div class="d-flex flex-start w-100 mb-2">';
            row += '<img class="rounded-circle shadow-1-strong me-3" src="../../img/profile_img/'+element["Immagine"]+'" alt="Immagine profilo" width="40" height="40" />';
            row += '<div class="form-outline w-100"><p class="text-muted small mb-0">'+element.Data+'</p><p class="mb-3">'+element.Testo+'</p></div></div>';
        });
        $("#contComment"+numero).html(row);
    })
    .fail(function(response) {
        console.log(response);
    });
}