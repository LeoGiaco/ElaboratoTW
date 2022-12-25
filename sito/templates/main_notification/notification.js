const fileint = "templates/main_notification/notification_api.php";

$(document).ready(function() {
    getNotifications();
});

function setOld(){
    const datas = new FormData(); 
    datas.append("request", "setOld");
    $.ajax({
        type: "POST",
        url: fileint,
        data:  datas, 
        processData: false,
        contentType: false
    })
    .done(function(data,success,response) {
    })
    .fail(function(response) {
        console.log(response);
    });
}

function getNotifications(){
    const datas = new FormData(); 
    datas.append("request", "getNotifications");
    $.ajax({
        type: "POST",
        url: fileint,
        data:  datas, 
        processData: false,
        contentType: false
    })
    .done(function(data,success,response) {
        singleNotify(data.dati.new, "notifNew")
        singleNotify(data.dati.old, "notifOld")
        setOld();
    })
    .fail(function(response) {
        console.log(response);
    });
}

function singleNotify(arr, idDiv){
    if(arr.length!=0){
        $("#"+idDiv).html("");     
        arr.forEach(elem => {
            let row = `
                <div class="py-3 px-1 d-flex align-items-center bg-light border-bottom">
                    <div class="dropdown-list-image mx-2">
                        <img class="rounded-circle" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="" width="50" height="50" />
                    </div>
                    <div class="font-weight-bold w-100">
                        <h3 class="m-0 text-break">${(elem.Tipologia).toUpperCase()}</h3>
                        <p class="text-muted small mb-0">${elem.Data}</p>
                        <p class="small m-0 text-break">${elem.Testo}</p>
                    </div>
                </div>
            `
            $("#"+idDiv).append(row);
        });
    }

}


