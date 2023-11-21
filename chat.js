$(document).ready(function () {
    alert("entra")
    
});

//#region === Nueva conversacion ===
$("#product-message").on('click', function () {
    var productoID = $(".idProducto").val();
    var vendedorID = $(".idVendedor").val();
    alert(productoID + " " + vendedorID)
    var data = {
        idProducto: productoID,
        idVendedor: vendedorID,
    };

    $.ajax({
        url: './API/msgAPI.php?action=chat',
        method: 'POST',
        data: data,
        success: function (result) {
            alert(result)
            sendFirstMessage();
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log('Error:', error);
        }
    });
});

function sendFirstMessage() {
    var productoID = $(".idProducto").val();
    var data = {
        message: "Me gustaria cotizar el precio del producto:",
    };
    alert("here")
    $.ajax({
        url: './API/msgAPI.php?action=startChat',
        method: 'POST',
        data: data,
        success: function (result) {
            alert(result)
            successMessageRedirect(productoID);
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log('Error:', error);
        }
    });
}

function successMessageRedirect(productID) {
    $.ajax({
        url: './API/msgAPI.php?action=getChat',
        method: 'POST',
        data: { productID: productID },
        success: function (result) {
            console.log(result);
            alert(result)

            loadChats();
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log('Error:', error);
        }
    });
}

function loadChats() {
    $.ajax({
        url: './API/msgAPI.php?action=loadChats',
        method: 'POST',
        success: function (result) {
            console.log(result)
            window.location.href = "msjCotizacion.php";
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log('Error:', error);
        }
    });
}

//#endregion

//#region === Send message ===
$("#sendBtn").on('click', function () {
    var inputValue = $('#inputMsg').val();

    var activeProductID = $('.active');
    var productID = activeProductID.find('.productID').val();

    var data = {
        message: inputValue,
    };

    $.ajax({
        url: './API/msgAPI.php?action=sendMessage',
        method: 'POST',
        data: data,
        success: function (result) {
            alert(result)
            successMessageRedirect(productID);
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log('Error:', error);
        }
    });
});

//#endregion

//#region === Change current chat ===
function currentChat(productID, listItem) {
    $('.list-group-item').removeClass('active');
    $(listItem).addClass('active');
    $.ajax({
        url: './API/msgAPI.php?action=chat',
        method: 'POST',
        data: {
            idProducto: -1,
            idVendedor: -1,
            dinamicID: productID
        },
        success: function (result) {
            console.log(result);
            successMessageRedirect(productID);
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log('Error:', error);
        }
    });
}
//#endregion
