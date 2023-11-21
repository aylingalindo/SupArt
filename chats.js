//#region === Nueva conversacion ===
function setChat(data) {
    $.ajax({
        url: './API/chatAPI.php?action=setCurrentChat',
        method: 'POST',
        data: data,
        success: function (result) {
            alert(result)
            console.log(result)
            loadChats();
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log('Error:', error);
        }
    });
}
$("#product-message").on('click', function () {
    var productoID = $(".idProducto").val();
    var vendedorID = $(".idVendedor").val();

    var data = {
        "idProducto": productoID,
        "idVendedor": vendedorID,
        "message": "Me gustaria cotizar el precio del producto:"
    };

    setChat(data);
});

//#endregion

//#region === Send message ===
$("#sendBtn").on('click', function () {
    var inputValue = $('#inputMsg').val();

    var activeProductID = $('.active');
    var productID = activeProductID.find('.productID').val();

    var data = {
        "message": inputValue,
    };

    $.ajax({
        url: './API/chatAPI.php?action=sendMessage',
        method: 'POST',
        data: data,
        success: function (result) {
            alert(result)
            loadChats();
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log('Error:', error);
        }
    });
});
//#endregion

//#region === Load chats on sidebar ===
function loadChats() {
    $.ajax({
        url: './API/chatAPI.php?action=getAllChats',
        method: 'POST',
        success: function (result) {
            console.log(result)
            alert(result)
            window.location.href = "msjCotizacion.php";
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log('Error:', error);
        }
    });
}
//#endregion

//#region === Change current chat ===
function currentChat(productID, listItem) {
    $('.list-group-item').removeClass('active');
    $(listItem).addClass('active');

    alert("this is the " + productID);
    var vendedorID = $(listItem).attr('receiverId');
    var data = {
        "idProducto": productID,
        "idVendedor": vendedorID,
        "message": "Me gustaria cotizar el precio del producto:"
    };
    setChat(data);
}
//#endregion

//#region === Clear chats ===
function clearChat() {
    $.ajax({
        url: './API/chatAPI.php?action=clearchats',
        method: 'POST',
        success: function (result) {
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log('Error:', error);
        }
    });
}
//#endregion
function initialSet() {
    var inputValue = $('#inputMsg').val();

    var activeProductID = $('.active');
    var productID = activeProductID.find('.productID').val();

    var data = {
        "message": inputValue,
        "productID": ''
    };

    $.ajax({
        url: './API/chatAPI.php?action=setCurrentChat',
        method: 'POST',
        data: data,
        success: function (result) {
            alert(result)
            console.log(result)
            initialChats(productID);
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log('Error:', error);
        }
    });
    
}

function initialChats(product) {
    currentChat(product);
}


