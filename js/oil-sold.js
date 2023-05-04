
$('#EditModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('whatever')
    var stitle = button.data('title')
    var spname = button.data('productsname')

    const godate = dayjs(button.data('sdate')).format('MMM DD, YYYY');
    console.log(godate)
    var quantity = button.data('sold')
    var modal = $(this)
    modal.find('#sold-id').val(id)
    modal.find('#title').val(stitle)
    modal.find('#selectedproduct').val(spname)
    modal.find('#saveDate').val(godate)
    modal.find('#ssold').val(quantity)
})

$('#deleteOil').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('whatever')

    var modal = $(this)
    modal.find()
    modal.find('#product-soldID').val(id)
})

$('#gasdelete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('whatever')

    var modal = $(this)
    modal.find()
    modal.find('#gas-soldID').val(id)
})


