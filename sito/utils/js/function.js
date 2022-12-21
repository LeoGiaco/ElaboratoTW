const fileintPost = "templates/main_posts/posts_api.php";
const fileProfile = "profile.php";
function select_file(file, request, id_select, valore, vuoto)
{
    const formdata = new FormData();
    formdata.append("request",request);
    formdata.append("valore_selected",valore);

    $.ajax({
        type: "POST",
        url: file,
        data: formdata, 
        processData: false,
        contentType: false
    })
    .done(function(data, success, response) {
        var rows = '',
        dati = data;
        $("#" + id_select).html('');

        if(vuoto == 1)
            $("#" + id_select).append('<option></option>');
        if(dati != '' && dati != null)
        {
            for(var i = 0; i < dati.length; i++)
            {
                var dati_s = dati[i];

                rows += '<option value="' + dati_s.cod_select + '"';
                if(dati[i].attr_select != '' && dati[i].attr_select!= null && dati[i].attr_select!= undefined)
                    rows += dati[i].attr_select;

                if(dati_s.cod_select == valore)
                    rows += ' selected';
                rows += '>' + dati_s.descr_select +'</option>';
            }
            $("#" + id_select).append(rows);
        }
    })
    .fail(function(response) {
        return_fail(response);
    });
}


function getFormData(id_form)
{
    let indexed_array = {};
    const formData = new FormData();
    
    if($("#" + id_form).is( "form" )==true)
    {
        let $form = $("#" + id_form);
        let unindexed_array = $form.serializeArray();
        unindexed_array.forEach(element => {
            formData.append(element.name, element.value);
        });
    }
    return formData;
}

function addAlert(id_append,classe,message,time_remove)
{
    
    var alert = $('<div class="alert '+classe+'">' + '<button type="button" class="close" data-dismiss="alert" onClick="$(this).parent().remove()">' +
    '&times;</button>' + message + '</div>');

    if(time_remove=='x')
        setTimeout(function () { alert.remove(); }, 5000);
    else if(time_remove!='' && time_remove!=undefined)
        setTimeout(function () { alert.remove(); }, time_remove);

    $('#'+id_append).html(alert);
}

// Sezione dei post

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

function commentiPost(numero){
    const datas = getFormData("formPost");
    datas.append("request", "commentiPost");
    datas.append("idPost", numero);
    $.ajax({
        type: "POST",
        url: fileintPost,
        data:  datas, 
        processData: false,
        contentType: false
    })
    .done(function(data,success,response) {
        let row='';
        data.forEach(element => {
            // Manca la data del commento.
            row += `
                <div class="d-flex flex-start w-100 mb-2">
                    <a href="${fileProfile}?id=${element.Utente}">
                        <img class="rounded-circle shadow-1-strong me-3" src="images/profile_img/${element["Immagine"]}" alt="Immagine profilo" width="40" height="40" />
                    </a>
                    <div class="form-outline w-100">
                        <p class="text-muted small mb-0">${element.Data}</p>
                        <p class="mb-3 comLunghi">${element.Testo}</p>
                    </div>
                </div>
            `;
        });
        $("#contComment"+numero).html(row);
    })
    .fail(function(response) {
        console.log(response);
    });
}

function visualizzaPost(numeroPost, aggiuntaPost=false, utente="", checked=false){
    setAlertLoad();
    const datas = new FormData();
    datas.append("request", "getPosts");
    datas.append("numeroPost", numeroPost);
    datas.append("utente", utente);
    datas.append("checked", checked);
    $.ajax({
        type: "POST",
        url: fileintPost,
        data:  datas, 
        processData: false,
        contentType: false
    })
    .done(function(data,success,response) {
        const dati=data["posts"];
        postsLoaded+=data["posts"].length;
        let row = '';
        for(let i=0; i<dati.length; i++){
            const temp=processaLike(dati[i]);
            const like=temp[0];
            const dislike=temp[1];
            row += ` <article id="post${dati[i]["ID"]}" class="card my-2">
                        <div class="card-body"><div class="d-flex flex-start align-items-center">
                            <a href="${fileProfile}?id=${dati[i]["Utente"]}"><img class="rounded-circle shadow-1-strong mr-2 me-2" src="images/profile_img/${dati[i]["Immagine"]}" alt="avatar user" width="60" height="60" /></a>
                            <div>
                                <a href="${fileProfile}?id=${dati[i]["Utente"]}"><p class="fw-bold mb-1 text-left">${dati[i]["Utente"]}</p></a>
                                <p class="text-muted small mb-0">${dati[i]["Data"]}</p>
                            </div>
                        </div>
                        <div>
                            <h3 class="mt-3 mb-2 pb-2">${dati[i]["Titolo"]}</h3>
            `;
            if(dati[i]["Media"]!==""){
                row += `<div class="text-center">
                            <img src="images/post_img/${dati[i]["Media"]}" alt="Immagine del post intitolato:${dati[i]["Titolo"]}" class="img-responsive"/>
                        </div>`;
            }
            row += `<p class="mt-3 mb-2 pb-2">${dati[i]["Testo"]}</p>
                    <div class="small d-flex justify-content-start">
                        <button id="btnLike${dati[i]["ID"]}" class="d-flex align-items-center me-3 btn-3 btn-transition-up btn-sm" data-type="like" data-numero="${dati[i]["ID"]}" >Like: ${like}</button>
                        <button id="btnDislike${dati[i]["ID"]}" class="d-flex align-items-center me-3 btn btn-4 btn-transition-down btn-sm" data-type="dislike" data-numero="${dati[i]["ID"]}">Dislike: ${dislike}</button>
                        <button class="d-flex align-items-center me-3 btn btn-1 btn-sm" data-type="commento" data-numero="${dati[i]["ID"]}">Commento</button>
                    </div>
                </div>
            </div>
            <div class="card-footer py-3 border-0 collapse" id="divCommento${dati[i]["ID"]}">
                <div id="contComment${dati[i]["ID"]}"></div>
                <div class="d-flex flex-start w-100">
                    <form id="comS${dati[i]["ID"]}" class="form-outline w-100">
                        <label class="form-label" for="inpCommento${dati[i]["ID"]}">Commento: </label>
                        <input class="form-control" id="inpCommento${dati[i]["ID"]}" name="testo" placeholder="Inserisci il testo del commento"/>
                    </form>
                </div>
                <div class="float-end mt-2 pt-1">
                    <button type="button" class="btn btn-1 btn-sm" data-type="comS" data-numero="${dati[i]["ID"]}">Commenta</button>
                </div>
            </div>
        </article>
            `;                  
        }
        if(aggiuntaPost){
            $("#contPosts").html(row);
        } else {
            $("#contPosts").append(row);
        }

        $("form").submit(function(event){
            event.preventDefault();
        });
        $("alertC").html("");
        caricamento=false;
    })
    .fail(function(response) {
        console.log(response);
    });
}


function gestioneBottoni(button){
    const btn = button,
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
                    url: fileintPost,
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
                url: fileintPost,
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
                url: fileintPost,
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
}

function setAlertLoad(){
    addAlert("alertC", "alert-warning", "Caricamento...", "");
}
// Fine gestione post.

// Setta gli interessi
function setInterests(){
    const formdata = new FormData();
    formdata.append("request", "interessiPossibili");
    $.ajax({
        type: "POST",
        url: "templates/main_signup/signup_api.php",
        data:  formdata,
        processData: false,
        contentType: false
    })
    .done(function(data,success,response) {
        const dati = data.dati;
        for(let i=0; i<dati.length; i++){
            $("#intset").append('<label for="'+dati[i]["Nome"]+'" class="mb-1 form-check-label"><input id="'+dati[i]["Nome"]+'" class="mx-2 form-check-input" type="checkbox" value="'+dati[i]["Nome"]+'" name="'+dati[i]["Nome"]+'"/>'+dati[i]["Nome"]+'</label>')
        }
    })
    .fail(function(response) {
        console.log(response);
    });    
}

// fine interessi.

// // Funzioni per criptaggio e decriptaggio
// function encryptPwd(password, salt){
//     return CryptoJS.TripleDES.encrypt(password, salt);
// }
// ​
// function decryptPwd(password, salt){
//     return CryptoJS.TripleDES.decrypt(password, salt);
// }