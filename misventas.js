$(document).ready(function () {
    alert("ventas")
    loadSales();
});

//#region === Cargar todas las ventas ===
function loadSales() {
    $.ajax({
        url: './API/salesAPI.php?action=getAll',
        method: 'POST',
        success: function (result) {
            console.log(result);
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log('Error:', error);
        }
    });
}

function loadSalesFilter(data) {
    $.ajax({
        url: './API/salesAPI.php?action=getAllFilter',
        method: 'POST',
        data: data,
        success: function (result) {
            console.log(result);
            alert("success")
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log('Error:', error);
        }
    });
}
//#endregion
/*
$("#filtrar").on("click", function(){
    var _category = $("#Cat").val();
    var _endDate = $("#endDate").val();
    var _startDate = $("#startDate").val();

    alert(_category + " " + _endDate + " " + _startDate);
    var data = {
        category: _category,
        endDate: _endDate,
        startDate: _startDate
    }

    loadSalesFilter(data);
})
*/
/*
$(document).ready(function () {
    // Function to load chats on sidebar when the page loads
    function loadChatsOnSidebar() {
        //$_SESSION['chatAPI']['current']['messages'] = array();
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
    if(!<?php if (isset($_SESSION['allchatsAPI'])){echo 'true';}else{echo 'false';}?>)
      window.location.href="msjCotizacion.php";
});
*/

/*
$_SESSION['estoyfiltrando']=1;
unset $_SESSION['estoyfiltrando']*/