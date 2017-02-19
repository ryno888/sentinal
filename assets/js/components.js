$(document).ready(function () {
    
    var bodyOb = $('body');
    
    //Handles menu drop down
    $('.dropdown-menu').find('form').click(function (e) {
        e.stopPropagation();
    });
    
    //--------------------------------------------------------------------------
    bodyOb.on("click", ".deleteError", function(){
        var file = $(this).attr("file");
        $.ajax({
            type: 'POST',
            data: "file="+file,
            url: ci_base_url+"index.php/index/xclear_error",
            cache: false,
            success: function(response){
                $('.errorPopup').html(response);
            }
        });
    });
    //--------------------------------------------------------------------------
    bodyOb.on("click", ".loginSubmit", function(){
        var data = $("#"+$(this).attr("formTarget")).serialize();
        $.ajax({
            type: 'POST',
            data: data,
            url: ci_base_url+"index.php/index/xlogin",
            cache: false,
            success: function(response){
                if(response.code == 1){
                    document.location = ci_base_url+"index.php/person/vlist";
                }else{
                    messageModal(response.title, response.message);
                }
            }
        });
    });
    
    //--------------------------------------------------------------------------
});

//--------------------------------------------------------------------------
function fadeIn(element, time){
    if(time == undefined){ time = 200; }
    $(element).fadeIn({duration : time, queue : false});
}
//------------------------------------------------------------------------------
function messageModal(title, message){
    $('#modalMessageTitle').html(title);
    $('#modalMessageBody').html(message);
    $('#jqmMessageModal').modal('show');
}
//--------------------------------------------------------------------------