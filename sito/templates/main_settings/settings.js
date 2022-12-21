const fileint = "templates/main_settings/settings_api.php";

$(document).ready(function() {
    setInterests();
    checkInterests();

    $("nav").on("click",'button',function(){
        const typBtn = $(this).data("type");
        $(".section").hide().removeClass('d-none');
        $("#"+typBtn).show();
        $(".btnmenu button").attr("class", "nav-item nav-link")
        $('[data-type="'+typBtn+'"]').attr('class', 'nav-item nav-link ' + "active");
    });

    $("#security").on("click",'button',function(){
        const datas = getFormData("frmSecurity");
        if(datas.get("new") === datas.get("newk")){
            datas.delete("newk");
            datas.set("old", CryptoJS.MD5(datas.get("old")).toString());
            datas.set("new", CryptoJS.MD5(datas.get("new")).toString());
            datas.append("request", "changePwd");
            $.ajax({
                type: "POST",
                url: fileint,
                data:  datas, 
                processData: false,
                contentType: false
            })
            .done(function(data,success,response) {
                if(data.stato === false){
                    addAlert("alert","alert-danger", data.msg,"");
                } else {
                    addAlert("alert","alert-success", data.msg,"x");
                    $("#frmSecurity").trigger("reset");
                }
            })
            .fail(function(response) {
                console.log(response);
            });
        } else {
            addAlert("alert","alert-danger", "Le password non corrispondono!","");
        }
    });

    $("#interests").on("click",'button',function(){
        const datas = getFormData("frmInterests");
        datas.append("request", "changeIntr");
        $.ajax({
            type: "POST",
            url: fileint,
            data:  datas, 
            processData: false,
            contentType: false
        })
        .done(function(data,success,response) {
            if(data.stato === false){
                addAlert("alert","alert-danger", data.msg,"");
            } else {
                addAlert("alert","alert-success", data.msg,"x");
            }
        })
        .fail(function(response) {
            console.log(response);
        });

    });


});

function checkInterests(){
    const datas = new FormData();
    datas.append("request", "getInterests");

    $.ajax({
        type: "POST",
        url: fileint,
        data:  datas, 
        processData: false,
        contentType: false
    })
    .done(function(data,success,response) {
        data.interests.forEach(element => {
            $("#"+element.InterNome).prop('checked', true);
        });
    })
    .fail(function(response) {
        console.log(response);
    });
}