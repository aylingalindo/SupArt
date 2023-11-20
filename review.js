$(document).ready(function () {
    alert("dsf");
    // Manejar la selecci�n de la calificaci�n con �conos
    $('.calif').on('click', function () {
        alert("clicking on ");
        var index = $(this).index();
        var icons = $(this).parent().find('.icon.ion-md-brush');

        icons.each(function (i) {
            if (i <= index) {
                $(this).addClass('yes').removeClass('no');
            } else {
                $(this).addClass('no').removeClass('yes');
            }
        });
    });

    $('.submitBtn').click(function () {
        var parentRow = $(this).closest('tr');
        var productId = parentRow.find('.productId').val();
        var comment = parentRow.find('.comment').val();
        var score = parentRow.find('.califInput .icon.ion-md-brush.yes').length;

        if (productId && comment && score) {
            $.ajax({
                type: 'POST',
                url: 'submit_review.php',
                data: {
                    productId: productId,
                    score: score,
                    comment: comment
                },
                success: function (response) {
                    alert('�La calificaci�n se ha enviado correctamente!');
                    // Acciones adicionales despu�s de enviar la calificaci�n
                },
                error: function (error) {
                    alert('Ha ocurrido un error al enviar la calificaci�n.');
                }
            });
        } else {
            alert('Por favor, complete todos los campos y seleccione una calificaci�n.');
        }
    });
});
