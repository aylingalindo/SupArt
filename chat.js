$(document).ready(){
    if (window.location.href.indexOf("msjCotizacion.php") > -1) {
        // Code specific to "example.html"
        alert("on msj")
    } else {
        alert("not on msj")
    }
}
//#region === Nueva conversacion ===
$("#product-message").on('click', function () {
    var msgButton = $(this);
    var productoID = msgButton.closest('div').find(".idProducto").val();
    var vendedorID = msgButton.closest('div').find(".idVendedor").val();
    alert(productoID + " " + vendedorID)
    var data = {
        idProducto: productoID,
        idVendedor: vendedorID
    };

    $.ajax({
        url: './API/msgAPI.php?action=chat',
        method: 'POST',
        data: data,
        success: function (result) {
            //ya trae datos del id del prod y id del vendedor
            //poner dinamicamente con codigo tal vez en php el nombre del producto en el chat y mandar automaticamente el msj
            window.location.href = "msjCotizacion.php";
            sendFirstMessage();
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log('Error:', error);
        }
    });
})

function sendFirstMessage() {
    var data = {
        message: "Me gustaria cotizar el precio del producto:",
    };
    $.ajax({
        url: './API/msgAPI.php?action=startChat',
        method: 'POST',
        data: data,
        success: function (result) {
            alert(result)
            successMessageRedirect();
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log('Error:', error);
        }
    });
}
function successMessageRedirect() {
    alert("on success")
    $.ajax({
        url: './API/msgAPI.php?action=getChat',
        method: 'POST',
        success: function (result) {
            alert("bien")
            console.log(result)
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log('Error:', error);
        }
    });
}
//#endregion