const fileint = "templates/main_settings/settings_api.php";

$(document).ready(function() {

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
                    addAlert("alert","alert-success", data.msg,"");
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


});