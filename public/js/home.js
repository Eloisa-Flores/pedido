$('#deleteModal').on('show.bs.modal', function (e) {
    var button = $(e.relatedTarget);
    var id = button.data('id');
    var pedido= button.data('pedido');

    var modal=$(this);
    modal.find('.modal-footer #id').val(id);
    modal.find('.modal-body #pedido').text(pedido);
});
$('#editModal').on('show.bs.modal', function (e) {
    var button = $(e.relatedTarget);
    var id = button.data('id');
    var pedido= button.data('pedido');
    var descripcion = button.data('descripcion');
    var fabrica = button.data('fabrica');
    var nota = button.data('nota');
    var fechapedido = button.data('fechapedido');
    var fecharequerida = button.data('fecharequerida');
    var empaque = button.data('empaque');
    var cantidadoriginal = button.data('cantidadoriginal');
    var catidadrecibida = button.data('catidadrecibida');
    var cantidadpendiente = button.data('cantidadpendiente');


    var modal=$(this);
    modal.find('.modal-footer #id').val(id);
    modal.find('.modal-body #pedido').val(pedido);
    modal.find('.modal-body #descripcion').val(descripcion);
    modal.find('.modal-body #fabrica').val(fabrica);
    modal.find('.modal-body #fechapedido').val(fechapedido);
    modal.find('.modal-body #fecharequerida').val(fecharequerida);
    modal.find('.modal-body #empaque').val(empaque);
    modal.find('.modal-body #cantidadoriginal').val(cantidadoriginal);
    modal.find('.modal-body #catidadrecibida').val(catidadrecibida);
    modal.find('.modal-body #cantidadpendiente').val(cantidadpendiente);
});


