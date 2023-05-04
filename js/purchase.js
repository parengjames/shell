$(document).ready(function(){
    sup_purchase();
})


function sup_purchase(){
    $('#transactModal').on('show.bs.modal',function(event){
        var button = $(event.relatedTarget);

        var id = button.data('whatever');
        var prodname = button.data('transName')

        var modal = $(this)
        modal.find('#product-id').val(id);
        modal.find('#title').val(prodname)
    })
}