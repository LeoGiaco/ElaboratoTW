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
    else if(id_form=='form_session_generale')//caso dell'iframe
    {
        var window_parent = window.parent;

        while(window_parent != window.top)
            window_parent = window_parent.parent;

        var $form = $("#" + id_form, window_parent.parent.document);
        var unindexed_array = $form.serializeArray();

        $.map(unindexed_array, function(n, i) {
            indexed_array[n['name']] = n['value'];
        });
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