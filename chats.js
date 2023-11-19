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
        idProducto: productoID,
        idReciever: vendedorID,
        message: "Me gustaria cotizar el precio del producto:"
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
        message: inputValue,
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
function currentChat(recieverID, productID, listItem) {
    $('.list-group-item').removeClass('active');
    $(listItem).addClass('active');

    alert("this is the " + productID);
    var _receiverID = recieverID
    alert("this is the " + _receiverID);
    var data = {
        idProducto: productID,
        idReciever: _receiverID,
        message: "Me gustaria cotizar el precio del producto:"
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
        message: inputValue,
        productID: ''
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


$(document).ready(function () {
    // Function to load chats on sidebar when the page loads
    function loadChatsOnSidebar() {
        $.ajax({
            url: './API/chatAPI.php?action=getAllChats', // Adjust URL as per your file structure
            method: 'POST',
            success: function (result) {
            },
            error: function (xhr, status, error) {
                console.error('Error:', error);
            }
        });
    }

    // Call the function to load chats on sidebar when the page loads
    loadChatsOnSidebar();
});
