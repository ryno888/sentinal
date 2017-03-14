$(document).ready(function () {
    
    var bodyOb = $('body');
    //--------------------------------------------------------------------------
    bodyOb.on("click", ".form-submit", function(e){
        e.preventDefault();
        var form = $("#"+$(this).attr("formTarget"));
        $.ajax({
            type: "POST",
            url: form.attr("action"),
            data: form.serialize(),
            success: function (data) {
                if(data.code == 1){
                    errorMessageModal(data.message);
                }else{
                    location.reload();
                }
            },
            error: function () {
                alert('fail');
            }
        });
    });
    //--------------------------------------------------------------------------
});

//--------------------------------------------------------------------------
function requestUpdate(url){
    document.location= ci_base_url+'index.php/'+url;
}
//--------------------------------------------------------------------------
$('#jqmModalConfirm').on('show.bs.modal', function(e) {
    $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

    $('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
});
//--------------------------------------------------------------------------
function requestFunction(url, func, options){
    var options_obj = $.extend({
        data: false,
        success: function() {},
        error: function() {},
        form: false,
        confirm: false,
        confirm_message: "Are you sure you want to continue",
    }, (options == undefined ? {} : options));
    
    if(options_obj.confirm){
        messageConfirm(options_obj.confirm_message, function(){
            $.ajax({
                type: "POST",
                url: ci_base_url+'index.php/'+url,
                data: options_obj.data,
                form: options_obj.form,
                success: (func == undefined ? function() {} : func),
                error: options_obj.error
            });
            location.reload();
        })
    }else{
        $.ajax({
            type: "POST",
            url: ci_base_url+'index.php/'+url,
            data: options_obj.data,
            form: options_obj.form,
            success: (func == undefined ? function() {} : func),
            error: options_obj.error
        });
    }
    
                
}
//------------------------------------------------------------------------------
function messageConfirm(message, ok_callback, cancel_callback, title) {
    // params
    $('#modalConfirmOkBtn').prop('onclick',null).off('click');
    $('#modalConfirmCancelBtn').prop('onclick',null).off('click');
    $('#modalConfirmOkBtn').click(ok_callback == undefined ? function () {} : ok_callback);
    $('#modalConfirmCancelBtn').click(cancel_callback == undefined ? function () {} : cancel_callback);

    // create and show dialog
    $('#modalConfirmTitle').html((title == undefined ? 'Confirm' : title));
    $('#modalConfirmBody').html(message);
    $('#jqmModalConfirm').modal('show');
}
//------------------------------------------------------------------------------
function messageModal(title, message){
    $('#modalMessageTitle').html(title);
    $('#modalMessageBody').html(message);
    $('#jqmMessageModal').modal('show');
}
//------------------------------------------------------------------------------
function errorMessageModal(message, options){
    
    var options_obj = $.extend({
        title: "<i class='fa fa-exclamation-circle' aria-hidden='true'></i> The following input error(s) were found",
        modal_size: "modal-md"
    }, (options == undefined ? {} : options));
    
    $('#jqmMessageModal').children('.modal-dialog').addClass(options_obj.modal_size);
    
    $('#modalMessageTitle').html(options_obj.title);
    $('#modalMessageBody').html(message);
    $('#jqmMessageModal').modal('show');
}
//--------------------------------------------------------------------------
function fadeIn(element, time){
    if(time == undefined){ time = 200; }
    $(element).fadeIn({duration : time, queue : false});
}
//--------------------------------------------------------------------------
function fadeOut(element, time){
    if(time == undefined){ time = 200; }
    $(element).fadeOut({duration : time, queue : false});
}
//--------------------------------------------------------------------------