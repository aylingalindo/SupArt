$(document).ready(function () {
    // Manejar la selección de la calificación con íconos
    $(document).on('click', '.calif', function () {
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

    // Submit review button click event
    $(document).on('click', '.submitBtn', function () {
        var parentRow = $(this).closest('tr');
        var productId = parentRow.find('.productId').val();
        var comment = parentRow.find('.comment').val();
        var score = parentRow.find('.calif .icon.ion-md-brush.yes').length;

alert(comment + " " + productId + " " + score);

        if (productId && comment && score) {
            $.ajax({
                type: 'POST',
                url: './API/reviewAPI.php?action=insert',
                data: {
                    productId: productId,
                    score: score,
                    comment: comment
                },
                success: function (response) {
                    alert(response)
                    alert('¡La calificación se ha enviado correctamente!');
                    // Acciones adicionales después de enviar la calificación
                },
                error: function (error) {
                    alert('Ha ocurrido un error al enviar la calificación.');
                }
            });
        } else {
            alert('Por favor, complete todos los campos y seleccione una calificación.');
        }
    });
});
