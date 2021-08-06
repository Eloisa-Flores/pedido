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
    var codigo= button.data('codigo');

    var descripcion = button.data('descripcion');
    var fabrica = button.data('fabrica');
    var nota = button.data('nota');
    var fecha_pedido = button.data('fecha_pedido');
    var fecha_requerida = button.data('fecha_requerida');
    var empaque = button.data('empaque');
    var cantidad_original = button.data('cantidad_original');
    var cantidad_recibida = button.data('cantidad_recibida');
    var cantidad_pendiente = button.data('cantidad_pendiente');


    var modal=$(this);
    modal.find('.modal-footer #id').val(id);
    modal.find('.modal-body #pedido').val(pedido);
    modal.find('.modal-body #descripcion').val(descripcion);
    modal.find('.modal-body #codigo').val(codigo);

    modal.find('.modal-body #nota').val(nota);
    modal.find('.modal-body #fabrica').val(fabrica);
    modal.find('.modal-body #fecha_pedido').val(fecha_pedido);
    modal.find('.modal-body #fecha_requerida').val(fecha_requerida);
    modal.find('.modal-body #empaque').val(empaque);
    modal.find('.modal-body #cantidad_original').val(cantidad_original);
    modal.find('.modal-body #cantidad_recibida').val(cantidad_recibida);
    modal.find('.modal-body #cantidad_pendiente').val(cantidad_pendiente);
});


