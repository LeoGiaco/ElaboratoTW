function getFormData(id_form)
{
    var indexed_array = {};
//    console.log(id_form);
    if($("#" + id_form).is( "form" )==true)
    {
        var $form = $("#" + id_form);
        var unindexed_array = $form.serializeArray();

        $.map(unindexed_array, function(n, i) {

            if(n['name'].substring(n['name'].length - 2, n['name'].length)=='[]')
            {
                if(indexed_array[n['name'].substring(0, n['name'].length-2)]==undefined)
                    indexed_array[n['name'].substring(0, n['name'].length-2)] = [];

                indexed_array[n['name'].substring(0, n['name'].length-2)].push(n['value']);
            }
            else
                indexed_array[n['name']] = n['value'];
        });

        if(id_form=='form_session_generale' && $("#form_session_generale_p").is( "form" )==true) //recupero anche i dati di sessione della somministrazione desktop se ci sono
        {
            var indexed_array_p = getFormData('form_session_generale_p');
            $.extend(indexed_array, indexed_array_p);
        }
    }
    else
    {
        $("#"+id_form).each(function() {
            $(this).find('input:text, input:hidden, input:password, input:file, input:checkbox, select, textarea').each(function() {
                if($(this)[0].type=='checkbox')
                {
                    if($(this)[0].checked==true)
                        indexed_array[$(this)[0].name] = $(this)[0].value;
                    else
                        indexed_array[$(this)[0].name] = '';
                }
                else
                    indexed_array[$(this)[0].name] = $(this)[0].value;
            });
        });
    }

    return indexed_array;
}

function addAlert(id_append,classe,message,time_remove)
{
    
    var alert = $('<div class="alert '+classe+'">' + message + '</div>');

    if(time_remove=='x')
        setTimeout(function () { alert.remove(); }, 5000);
    else if(time_remove!='' && time_remove!=undefined)
        setTimeout(function () { alert.remove(); }, time_remove);

    $('#'+id_append).html(alert);
}