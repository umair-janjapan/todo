$(document).ready(function(){

	search();
	function search(newSearch = true) {
        var data = {};

        $('.no_result_div').addClass('d-none');

        data['current'] = parseInt($('#src-current').val());
        data['rowCount'] = $('#src-rowCount').val();

        $.ajax({
            url: base_url+'notes/search',
            data: data,
            type: 'POST',
            dataType: 'json',
            beforeSend: function (xhr) {
                
            },
            complete: function (jqXHR, textStatus) {
                if (jqXHR.status == 200) {
                    var result = jqXHR.responseText;
                    result = JSON.parse(result);
                    if (result.hasOwnProperty('success') && result.hasOwnProperty('html')) {
                        
                        setTimeout(function () {
                        	
                            $('.notes_list').append(result.html);
                            if (!result.html.length) {
                                $('.no_result_div').removeClass('d-none');
                            }
                        }, 600);


                        $('#src-current').val(result.current);
                        $('#src-rowCount').val(result.rowCount);
                    } else if (result.hasOwnProperty('error')) {
                        show_message(result.msg, "error");
                    }
                } else {
                    show_message("Contact Support - " + jqXHR.status, "error");
                }

                load_data_lock = false;
                $('.loader_search_wrap .loader').addClass('d-none');
            }
        });
    }

	var load_data_lock = false;
    $(window).scroll(function () {

        if($(window).scrollTop() + $(window).height() == $(document).height()) {
            
            if(load_data_lock == false){
                load_data_lock = true;
                search(false);
                setTimeout(function () {
                    load_data_lock = false;
                }, 10000);
            }
        }
    });

});

function removeNote(result, elm){

    elm.parents('.note').fadeOut('slow');
}

