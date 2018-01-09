$(function () {

    var vote = {
        success: function () {
            $(this).find('input,select,button').attr('disabled', 'disabled');
            $(this).find('button').text('Ya votado');
            if ($(document).find('button').length === $(document).find('button:disabled').length) {
                window.location.reload();
            }
        },
        fail: function () {
            alert('Error al registrar voto');
        }
    }

    $('.vote').on('submit', function (event) {
        var params = $(this).serialize(),
            form = $(this);
        event.preventDefault();

        $.post('/voting', params)
            .done(vote.success.bind(form))
            .fail(vote.fail);

    });

});
