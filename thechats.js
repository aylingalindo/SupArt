$(document).ready(function () {
    loadChatsBar();
})

function loadChatsBar(){
    alert("on load chat")
    $.ajax({
        url: './API/chatAPI.php?action=loadChats',
        method: 'POST',
        success: function (result) {
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log('Error:', error);
        }
    });
}

function loadCurrentChat(data){
    $.ajax({
        url: './API/chatAPI.php?action=loadCurrent',
        method: 'POST',
        data: data,
        success: function (result) {
        },
        error: function (xhr, status, error) {
            // Handle errors here
            alert(error)
            console.log('Error:', error);
        }
    });
}

//#region === Change current chat ===
function currentChat(productID, listItem) {
    $('.list-group-item').removeClass('active');
    $(listItem).addClass('active');

    var vendedorID = $(".recieverID").val();

    var data = {
        idProducto: productID,
        idReciever: vendedorID
    };

    loadCurrentChat(data);
}

function noCurrentChat(){
    $('.list-group-item').removeClass('active');
}
//#endregion