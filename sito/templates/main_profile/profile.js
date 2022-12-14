const fileint = "../templates/main_profile/profile_api.php";

$(document).ready(function() {
    getUserInfo();
});



function getUserInfo(){
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
        const dati = data.dati[0];
        $("#imgUtente").attr("src", "../../img/profile_img/"+dati["Immagine"]);
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
