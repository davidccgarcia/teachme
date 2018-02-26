$(document).ready(function () {

    var alert = new Alert('#notifications');

    $('.btn-vote').click(function (e) {
        e.preventDefault();

        var form = $('#form-vote');
        var button = $(this);

        var ticket = button.closest('.ticket');
        var id = ticket.data('id');
        var action = form.attr('action').replace(':id', id);

        button.addClass('hidden');

        $.post(action, form.serialize(), function (response) {
            
            ticket.find('.btn-unvote').removeClass('hidden');
            alert.success('¡Gracias por su voto!');

        }).fail(function () {
            
            button.removeClass('hidden');
            alert.error('¡Ocurrió un error!');
        });

    });

    $('.btn-unvote').click(function (e) {
        e.preventDefault();

        var form = $('#form-unvote');
        var button = $(this);

        var ticket = button.closest('.ticket');
        var id = ticket.data('id');
        var action = form.attr('action').replace(':id', id);

        button.addClass('hidden');

        $.post(action, form.serialize(), function (response) {
            
            ticket.find('.btn-vote').removeClass('hidden');
            alert.success('¡Su voto ha sido eliminado!');

        }).fail(function () {
            
            button.removeClass('hidden');
            alert.error('¡Ocurrió un error!');
        });

    });
});