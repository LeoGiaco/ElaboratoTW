function select_file(file, request, filtri_data, id_select, valore, vuoto)
{
    if(filtri_data == "")
        var filtri_data = {};
    $.extend(filtri_data, {'request': request,'valore_selected': valore});
    $.ajax({
        type: "POST",
        url: file,
        data: filtri_data
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
    var indexed_array = {};
    // if($("#" + id_form).is( "form" )==true)
    // {
    //     alert("entrato");
    //     var $form = $("#" + id_form);
    //     var unindexed_array = $form.serializeArray();
    //     $.map(unindexed_array, function(n, i) {

    //         if(n['name'].substring(n['name'].length - 2, n['name'].length)=='[]')
    //         {
    //             if(indexed_array[n['name'].substring(0, n['name'].length-2)]==undefined)
    //                 indexed_array[n['name'].substring(0, n['name'].length-2)] = [];

    //             indexed_array[n['name'].substring(0, n['name'].length-2)].push(n['value']);
    //         }
    //         else
    //             indexed_array[n['name']] = n['value'];
    //     });
    // }
    // else
    // {
        $("#"+id_form).each(function() {
            $(this).find('input:text, input:hidden, input:password, input:file, input:checkbox, select, textarea').each(function() {
                if($(this)[0].type=='checkbox')
                {
                    if($(this)[0].checked==true)
                        indexed_array[$(this)[0].name] = $(this)[0].value;
                    else
                        indexed_array[$(this)[0].name] = '';
                }
                else {
                    indexed_array[$(this)[0].name] = $(this)[0].value;
                }
            });
        });
    // }

    return indexed_array;
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