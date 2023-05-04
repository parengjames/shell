
$('#oilmodal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('whatever')
    var prodname = button.data('pname')
    var prodliters = button.data('pliters')
    var prodprice = button.data('pprice')
    var prodonhand = button.data('onhand')
    var prodstored = button.data('stored')
    var modal = $(this)
    modal.find('#prod-id').val(id)
    modal.find('#prodname').val(prodname)
    modal.find('#size').val(prodliters)
    modal.find('#prodprice').val(prodprice)
    modal.find('#onhand').val(prodonhand)
    modal.find('#stored').val(prodstored)
})


$('#oilDelete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('whatever')

    var modal = $(this)
    modal.find('#product-id').val(id)
})

$('#gasEdit').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('whatever')
    var Gasname = button.data('pname')
    var Fortypes = button.data('types')
    var prodprice = button.data('pprice')
    var prodonhand = button.data('onhand')
    var prodstored = button.data('gasstored')
    var modal = $(this)
    modal.find('#gas-id').val(id)
    modal.find('#gname').val(Gasname)
    modal.find('#gasType').val(Fortypes)
    modal.find('#gasprice').val(prodprice)
    modal.find('#avail').val(prodonhand)
    modal.find('#allGas').val(prodstored)
})


$('#gasDelete').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('whatever')

    var modal = $(this)
    modal.find('#gasoline-id').val(id)        
})

$('#supplyOil').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('whatever')
    var name = button.data('oilname')
    var type = button.data('transaction')
    var modal = $(this)
    modal.find('#oilsupply-id').val(id)
    modal.find('#oilName').val(name)
    modal.find('#transType').val(type)
})
$('#supplyGas').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget);
    var id = button.data('whatever')
    var name = button.data('gasname')
    var modal = $(this)
    modal.find('#gassupply-id').val(id)
    modal.find('#gasName').val(name)
})