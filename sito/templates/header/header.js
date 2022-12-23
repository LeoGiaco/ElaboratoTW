$(document).ready(function() {
    $('a[type="button"]').click(function() {
        const datas = new FormData(); 
        datas.append("request", "exit");
        $.ajax({
            type: "POST",
            url: "templates/header/header_api.php",
            data:  datas, 
            processData: false,
            contentType: false
        })
        .done(function(data,success,response) {
            console.log(data);
            window.location.href="login.php";
        })
        .fail(function(response) {
            console.log(response);
        });
    });
});

   
