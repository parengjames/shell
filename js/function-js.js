$(document).ready(function(){
    get_ID_edit();
})
$(document).ready(function(){
    get_ID();
})
$(document).ready(function(){
    get_ID_delete();
})


function get_ID(){
    $('#ApproveModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('whatever')
        
        var modal =$(this)
        modal.find('.modal-body input').val(id)
    })
}
function get_ID_edit(){
    $('#EditModal').on('show.bs.modal', function (event) 
   {
    var button = $(event.relatedTarget);
    var id = button.data('whatever')
    var fname = button.data('fname')
    var lname = button.data('lname')
    var username = button.data('user')
    var type = button.data('type')
        var modal =$(this)
        modal.find('#user-id').val(id)
        modal.find('#firstName').val(fname)
        modal.find('#lastName').val(lname)
        modal.find('#userName').val(username)
        modal.find('#userType').val(type)
   })
}
function get_ID_delete(){
    $('#DeleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('whatever')
        
        var modal =$(this)
        modal.find('#user-id').val(id)        
    })
}