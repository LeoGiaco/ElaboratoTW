const fileint = "templates/main_profile/profile_api.php";
let postsLoaded = 0;

$(document).ready(function() {
    const user = $("#user").val();
    checkFollow(user);
    listAccesibility("btnSeguaci");
    listAccesibility("btnSeguiti");
    getUserInfo(user);
    getFriendship(user);

    // Aggiunta dei post.
    visualizzaPost(postsLoaded, false, user);
    postsLoaded += 5;

    $("#contPosts").on("click",'button',function(){
        gestioneBottoni($(this));
    });

    $("#btnSegui").click(function(){
        const btn = $(this),
            type = btn.data('action');
        modifyFollow(type, user);
        
    });
    
    window.onscroll = function() {
        if (window.innerHeight + window.scrollY >= document.body.offsetHeight-10) {
            visualizzaPost(postsLoaded, false, user);
            postsLoaded += 5;
        }
    };
});


function modifyFollow(type, user){
    const datas = new FormData(); 
    datas.append("request", "modifyFollow");
    datas.append("type", type);
    datas.append("user", user);
    $.ajax({
        type: "POST",
        url: fileint,
        data:  datas, 
        processData: false,
        contentType: false
    })
    .done(function(data,success,response) {
        if(data.dati){
            checkFollow(user);
            getFriendship(user);
        }                
    })
    .fail(function(response) {
        console.log(response);
    });
}

function checkFollow(user){
    const datas = new FormData(); 
    datas.append("request", "checkFollow");
    datas.append("user", user);
    $.ajax({
        type: "POST",
        url: fileint,
        data:  datas, 
        processData: false,
        contentType: false
    })
    .done(function(data,success,response) {
        const dati = data.dati;
        $("#btnSegui").prop("disabled",dati.disabled);
        $("#btnSegui").text(dati.testo);
        $('#btnSegui').data('action', dati.btndata);                             
    })
    .fail(function(response) {
        console.log(response);
    });
}

function listAccesibility(name){
    $('#'+name+'[data-toggle="collapse"]').attr('aria-expanded', function() {
        return $(this).attr('aria-expanded') === 'false' ? 'true' : 'false';
    });
}

function getFriendship(user){
    const datas = new FormData(); 
    datas.append("request", "getFriendship");
    datas.append("user", user);
    $.ajax({
        type: "POST",
        url: fileint,
        data:  datas, 
        processData: false,
        contentType: false
    })
    .done(function(data,success,response) {
        const dati = data.dati;
        $("#seguaci").html(createListItem(dati.seguaci));
        $("#seguiti").html(createListItem(dati.seguiti));
        $("#nSeguaci").html(dati.seguaci.length);
        $("#nSeguiti").html(dati.seguiti.length);                                    
    })
    .fail(function(response) {
        console.log(response);
    });
}

function createListItem(elemento){
    let row = '';
    for(let i=0; i<elemento.length; i++){
        row += '<li class="list-group-item d-flex justify-content-between align-items-center">';
        row += '<div class="d-flex align-items-center">';
        row += '<img src="images/profile_img/'+elemento[i].Immagine+'" alt="Immagine profilo di '+elemento[i].Amico+'" width="40" height="40" class="rounded-circle" />';
        row += '<div class="ms-1">';
        row += '<p class="fw-bold mb-1">'+elemento[i].Amico+'</p>';
        row += '</div></div>';
        row += '<a class="btn btn-outline-primary btn-rounded btn-sm" href="pages/profile.php?id='+elemento[i].Amico+'" role="button">Vedi</a>';
        row += '</li>';  
    }
    return row;
}

function getUserInfo(user){
    const datas = new FormData(); 
    datas.append("request", "getUserInfo");
    datas.append("user", user);
    $.ajax({
        type: "POST",
        url: fileint,
        data:  datas, 
        processData: false,
        contentType: false
    })
    .done(function(data,success,response) {
        const dati = data.dati[0];
        $("#imgUtente").attr("src", "images/profile_img/"+dati["Immagine"]);
        $("#nominativo").text(dati["Nome"]+' '+dati["Cognome"]);
        $("#username").text(dati["Username"]);
        $("#sesso").append(' '+dati["Sesso"]);
        $("#nascita").append(' '+dati["DataNascita"]);
        for(let i=0; i<data.dati.length; i++){
            $("#interessi").append(" "+data["dati"][i]["InterNome"]);
        }
    })
    .fail(function(response) {
        console.log(response);
    });
}