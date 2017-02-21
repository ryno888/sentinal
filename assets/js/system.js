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