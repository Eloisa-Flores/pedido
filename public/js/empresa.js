$('#modalBorrarArea').on('show.bs.modal', function (e) {
    var button = $(e.relatedTarget);
    var id = button.data('id');
    var name= button.data('name');

    var modal=$(this);
    modal.find('.modal-footer #id').val(id);
    modal.find('.modal-body #nombreArea').text(name);
});
$('#modalEditarArea').on('show.bs.modal', function (e) {
    var button = $(e.relatedTarget);
    var id = button.data('id');
    var name= button.data('name');
    var codigo = button.data('codigo');

    var modal=$(this);
    modal.find('.modal-footer #id_marca').val(id);
    modal.find('.modal-body #name').val(name);
    modal.find('.modal-body #codigo').val(codigo);
});

$('#modalBorrarPrestaLibro').on('show.bs.modal', function (e) {
    var button = $(e.relatedTarget);
    var id = button.data('id');
    var cantidad_pendiente = button.data('cantidad_pendiente');

    var modal=$(this);
    modal.find('.modal-footer #id').val(id);
    modal.find('.modal-body #cantidad_pendiente').text(cantidad_pendiente);

});
