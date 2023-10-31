$(document).ready(function () {
})

/* MODAL agregar a carrito */
$("#addCart").on('click', function () {
    var items = $("#numItems").val();
    var data = {
        numItems: items
    };

    $.ajax({
        url: './API/cartsAPI.php?action=insert',
        method: 'POST',
        data: data,
        success: function (result) {
            window.location.href = "producto.php";
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log('Error:', error);
        }
    });
})

/* MODAL pagar producto*/
$("#btnBuy").on('click', function () {
    $("#payModal").modal('show');
})

$(".btnClose").on('click', function () {
    $("#payModal").modal('hide');

})