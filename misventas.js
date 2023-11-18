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
//#endregion