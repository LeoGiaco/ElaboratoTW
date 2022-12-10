const fileint = "../templates/main_posts/posts_api.php";

$(document).ready(function() {
    // $("#divCommento").hide();
    select_file(fileint, "datiTipologie", "slcGenere", "", "");
    visualizzaPost();
    
    $("#sctId").on('click','button',function(){
        const btn = $(this),
        type = btn.data('type'),
        numero = btn.data('numero');
        if(type=="commento"){
            if(document.getElementById("divCommento"+numero)===null){
                let row = '<div class="card-footer py-3 border-0" id="divCommento'+numero+'">';
                row += '<div class="d-flex flex-start w-100 mb-2">';
                row += '<img class="rounded-circle shadow-1-strong me-3" src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="Immagine profilo" width="40" height="40" />';
                // Sistemare con i commenti presenti nel db.
                row += '<div class="form-outline w-100">';
                row += '<label class="form-label" for="textAreaCommento">Testo commento</label></div></div>';
               
                row += '<div class="d-flex flex-start w-100">';
                row += '<img class="rounded-circle shadow-1-strong me-3" src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="Immagine profilo" width="40" height="40" />';
                row += '<form id="comS'+numero+'" class="form-outline w-100">';
                row += '<label class="form-label" for="textAreaCommento">Commento: </label>';
                row += '<textarea class="form-control" id="textAreaCommento" rows="1" name="testo" placeholder="Inserisci il testo del commento"></textarea></form></div>';
                // Sistema bottoni.
                row += '<div class="float-end mt-2 pt-1"><button type="button" class="btn btn-primary btn-sm" data-type="comS" data-numero="'+numero+'">Commenta</button>';
                row += '</div></div>';            
                $("#post"+numero).append(row);
            } else {
                document.getElementById("post"+numero).removeChild(document.getElementById("divCommento"+numero));
            }
        }else if(type=="comS"){
            const datas = getFormData("comS"+numero);
            datas.append("request", "aggiungiCommento");
            datas.append("nPost", numero);
            for (const value of datas.keys()) {
                console.log(value);
            }
            $.ajax({
                type: "POST",
                url: fileint,
                data:  datas, 
                processData: false,
                contentType: false
            })
            .done(function(data,success,response) {
                console.log(data);
            })
            .fail(function(response) {
                console.log(response);
            });
        }
    });

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
        // Cose da fare:
        // Mettere bene la foto profilo.
        let row = '';
        for(let i=0; i<data.length; i++){
            row += '<div id="post'+data[i]["ID"]+'" class="card"><div class="card-body"><div class="d-flex flex-start align-items-center">';
            row += '<img class="rounded-circle shadow-1-strong mr-2 me-2" src="../../img/profilo.jpg" alt="avatar user" width="60" height="60" />';
            row += '<div><p class="fw-bold text-primary mb-1 text-left">'+data[i]["Utente"]+'</p>';
            row += '<p class="text-muted small mb-0">'+data[i]["Data"]+'</p></div></div>';
            row += '<div><h3 class="mt-3 mb-2 pb-2">'+data[i]["Titolo"]+'</h3><p class="mt-3 mb-2 pb-2">'+data[i]["Titolo"]+'</p>';
            row += '<div class="small d-flex justify-content-start">';
            row += '<button id="btnLike" class="d-flex align-items-center me-3 btn btn-outline-success btn-sm" data-type="like" data-numero="'+data[i]["ID"]+'" >Like</button>';
            row += '<button id="btnDislike" class="d-flex align-items-center me-3 btn btn-outline-danger btn-sm" data-type="dislike" data-numero="'+data[i]["ID"]+'">Dislike</button>';
            row += '<button id="btnCommento" class="d-flex align-items-center me-3 btn btn-outline-primary btn-sm" data-type="commento" data-numero="'+data[i]["ID"]+'">Commento</button></div></div></div>';
            row += '</div>';
        }
        $("#contPosts").html(row);
    })
    .fail(function(response) {
        console.log(response);
    });
}

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
}