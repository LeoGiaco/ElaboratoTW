const fileint = "templates/main_search/search_api.php";

$(document).ready(function() {
    const datas = new FormData();
    datas.append("search", $("#textSearch").val());
    datas.append("request", "getResult");
    $.ajax({
        type: "POST",
        url: fileint,
        data:  datas, 
        processData: false,
        contentType: false
    })
    .done(function(data,success,response) {
        const elemento = data.dati;
        let row = '';
        for(let i=0; i<elemento.length; i++){
            row += '<li class="list-group-item d-flex justify-content-between align-items-center">';
            row += '<div class="d-flex align-items-center">';
            row += '<div class="image-wrapper-small"><img src="images/profile_img/'+elemento[i].Immagine+'" alt="Immagine profilo di '+elemento[i].Username+'" class="rounded-circle" /></div>';
            row += '<div class="ms-3">';
            row += '<p class="fw-bold mb-1">'+elemento[i].Username+'</p>';
            row += '</div></div>';
            row += '<a class="btn btn-1 btn-sm" href="profile.php?id='+elemento[i].Username+'" role="button">Vedi</a>';
            row += '</li>';  
        }
        if(elemento.length!=0)
            $("#ricercaList").html(row);
    })
    .fail(function(response) {
        console.log(response);
    });
});