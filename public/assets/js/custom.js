$(document).ready(function(){
    $('#confirm-delete').on('show.bs.modal', function(e) {
        $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
    });

    $('#confirm-edit').on('show.bs.modal', function(e) {
        $(this).find('form').attr('action', $(e.relatedTarget).data('href'));
        $(this).find('textarea').html($(e.relatedTarget).data('custom'));
        $(this).find('input[type="text"]').val($(e.relatedTarget).data('custom'));

        console.log($(e.relatedTarget).data('custom'));
    });
});