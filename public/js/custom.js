$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



$(".message").dialog({
	dialogClass: "no-close",
    autoOpen: false,
    resizable: false,
    height: "auto",
    width: '35%',
    modal: true,
    open: function(event, ui) {
        //$("input").blur();
    },
    show: {
        effect: "fade",
        duration: 500
    },
    hide: {
        effect: "fade",
        duration: 500
    },
    classes: {
        "ui-dialog": "highlight"
    },
    buttons: [

    ],
});

function show_message(message, type) {

    if (message == "") {
        return;
    }
    if (type == "success") {
        title = "Success";
    } else if (type == "error") {
        title = "Error";
    } else if (type == "errors") {
        title = "Error";
        var msg = "";
        $.each(message, function (i, v) {
            msg += v + "<br/>";
        });
        message = msg;
    }

    $(".message").dialog("option", "title", title);
    $(".message").html("<p>" + message + "</p>");
    $(".message").dialog("option", "buttons",
            [
                {
                    text: "Ok",
                    //icon: "ui-icon-heart",
                    dialogClass: 'success-dialog',
                    click: function () {
                        $(this).dialog("close");
                    }
                },
            ]
            );
    $(".message").dialog("open");
}

$(document).ready(function(){

	$('.preDef').submit(function(e){
		e.preventDefault();
	});

	


	function btn_action(elm) {

	    var data = elm.data();
	    var action = elm.attr('data-action');
	    var form = elm.attr('data-form');
	    var nav = elm.attr('data-nav');

	    var url = base_url + nav;
	    var form_data = [];
	    if (form != undefined) {
	        form_data = $("#" + form).serializeArray();
	    }

	    blocked_parm = ['nav', 'form', 'gridreload', 'resetform', 'postfunc'];

	    for (var key in data) {
	        if (!blocked_parm.includes(key)) {
	            form_data[form_data.length] = {name: key, value: data[key]};
	        }
	    }

	    //console.log(form_data);
	    //return true;

	    $.ajax({
	        url: url,
	        type: 'POST',
	        data: form_data,
	        dataType: 'json',
	        beforeSend: function (xhr) {
	            elm.attr('disabled', true);
	        },
	        complete: function (jqXHR, textStatus) {
	            elm.attr('disabled', false);

	            if (jqXHR.status == 200) {

	                var result = jqXHR.responseText;
	                result = JSON.parse(result);

	                if (result.hasOwnProperty('success')) {

	                    if (elm.data('resetform')) {
	                        $("#" + form)[0].reset();
	                    }

	                    if(result.hasOwnProperty('url')){
	                    	
	                    	window.location.href = result.url;

	                    }else{
	                    	show_message(result.msg, "success");	
	                    }

	                    if (elm.data('postfunc')) {
	                        var func_name = elm.data('postfunc');
	                        if (window[func_name]) {
	                            window[func_name](result, elm);
	                        }
	                    }

	                    

	                } else if (result.hasOwnProperty('errors')) {
	                    show_message(result.errors, "errors");
	                } else if (result.hasOwnProperty('error')) {
	                    show_message(result.msg, "error");
	                }
	            } else {
	                show_message("Contact Support - " + jqXHR.status, "error");
	            }
	        }
	    });
	}

	$(document).on("click", ".btn_action", function(e){
	    e.preventDefault();
	    btn_action($(this));
	});

});