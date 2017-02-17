$(document).ready(function () {
    
    var bodyOb = $('body');
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
//--------------------------------------------------------------------------