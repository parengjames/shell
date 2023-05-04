$(document).ready(function(){
    get_ID_edit();
})
$(document).ready(function(){
    get_ID_delete();
})

function get_ID_edit(){
    $('#EditModal').on('show.bs.modal', function (event) 
   {
    var button = $(event.relatedTarget);
    var id = button.data('whatever')
    var suppliername = button.data('sname')
    var supplieraddr = button.data('saddress')
        var modal =$(this)
        modal.find('#sup-id').val(id)
        modal.find('#supname').val(suppliername)
        modal.find('#supaddress').val(supplieraddr)
   })
}
function get_ID_delete(){
    $('#DeleteModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('whatever')
        
        var modal =$(this)
        modal.find('#sup-id').val(id)        
    })
}