/* 
 * Class 
 * @filename core 
 * @encoding UTF-8
 * @author Liquid Edge Solutions  * 
 * @copyright Copyright Liquid Edge Solutions. All rights reserved. * 
 * @programmer Ryno van Zyl * 
 * @date 14 Mar 2017 * 
 */


var system = {
    ajax: {
        requestFunction: function(url, func, options) {
            var options_obj = $.extend({
                data: false,
                success: function () {},
                error: function () {},
                form: false,
                confirm: false,
                confirm_message: "Are you sure you want to continue",
            }, (options == undefined ? {} : options));

            if (options_obj.confirm) {
                messageConfirm(options_obj.confirm_message, function () {
                    $.ajax({
                        type: "POST",
                        url: ci_base_url + 'index.php/' + url,
                        data: options_obj.data,
                        form: options_obj.form,
                        success: (func == undefined ? function () {} : func),
                        error: options_obj.error
                    });
                    location.reload();
                })
            } else {
                $.ajax({
                    type: "POST",
                    url: ci_base_url + 'index.php/' + url,
                    data: options_obj.data,
                    form: options_obj.form,
                    success: (func == undefined ? function () {} : func),
                    error: options_obj.error
                });
            }
        },
        
        submitForm: function(form_id, options){
            var form = $('#'+form_id);
            var options_obj = $.extend({
                data: false,
                success: function(data) {},
                error: function() {},
                confirm: false,
                confirm_message: "Are you sure you want to continue",
            }, (options == undefined ? {} : options));
            
            $.ajax({
                type: "POST",
                url: form.attr("action"),
                data: form.serialize(),
                success: options_obj.success,
                error: options_obj.error,
            });
        }
    },
    
    browser: {
        redirect: function(url){
            document.location= ci_base_url+'index.php/'+url;
        },
        
        confirm: function(message, ok_callback, cancel_callback, title) {
            // params
            $('#modalConfirmOkBtn').prop('onclick',null).off('click');
            $('#modalConfirmCancelBtn').prop('onclick',null).off('click');
            $('#modalConfirmOkBtn').click(ok_callback == undefined ? function () {} : ok_callback);
            $('#modalConfirmCancelBtn').click(cancel_callback == undefined ? function () {} : cancel_callback);

            // create and show dialog
            $('#modalConfirmTitle').html((title == undefined ? 'Confirm' : title));
            $('#modalConfirmBody').html(message);
            $('#jqmModalConfirm').modal('show');
        },
        message: function(title, message, options) {
            var options_obj = $.extend({
                fade_out_delay: false,
            }, (options == undefined ? {} : options));
            
            // params
            $('#modalMessageTitle').html(title);
            $('#modalMessageBody').html(message);
            $('#jqmMessageModal').modal('show');
            
            if(options_obj.fade_out_delay){
                setTimeout(function(){
                    $('#jqmMessageModal').modal('hide');
                }, options_obj.fade_out_delay);
            }
        },
        error: function(message, options){
            var options_obj = $.extend({
                title: "<i class='fa fa-exclamation-circle' aria-hidden='true'></i> The following input error(s) were found",
                modal_size: "modal-md"
            }, (options == undefined ? {} : options));

            $('#jqmMessageModal').children('.modal-dialog').addClass(options_obj.modal_size);

            $('#modalMessageTitle').html(options_obj.title);
            $('#modalMessageBody').html(message);
            $('#jqmMessageModal').modal('show');
        }
    },
    
    fadeIn: function(element, time){
        if(time == undefined){ time = 200; }
        $(element).fadeIn({duration : time, queue : false});
    },
    fadeOut: function(element, time){
        if(time == undefined){ time = 200; }
        $(element).fadeOut({duration : time, queue : false});
    },
    copyToClipboard: function (element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }
}