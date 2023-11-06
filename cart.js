$(document).ready(function () {
    loadCartItems();
})

//#region === MODALES ===

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
//#endregion

//#region === GET ALL CART PRODUCTS ===
function loadCartItems() {
    $.ajax({
        url: './API/cartsAPI.php?action=getAll',
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

//#region === DYNAMIC PRICE CHANGE ===
$(".cantidad").on('change', function () {
    var itemsInput = $(this);
    var items = itemsInput.val();

    var price = itemsInput.closest('tr').find(".cartPrice").val();
    var dynamicTotal = parseFloat(price) * parseFloat(items);


    var formattedPrice = formatPrices(dynamicTotal);

    var totalPriceElement = itemsInput.closest('tr').find(".cartPricePr");
    $(totalPriceElement).html(`Total: ${formattedPrice}`);
});

$('.cartPricePr[data-amount]').each(function () {
    const $element = $(this);
    const amount = parseFloat($element.data('amount'));
    if (!isNaN(amount)) {
        const formattedAmount = formatPrices(amount);
        $element.text('Total: ' + formattedAmount);
    }
});

function formatPrices(amount) {
    const formatter = new Intl.NumberFormat('es-MX', {
        style: 'currency',
        currency: 'MXN',
        minimumFractionDigits: 2,
    });
    const formattedAmount = formatter.format(amount);
    return formattedAmount;
}
//#endregion

//#region === UPDATE PRODUCT CART ===
$(".cart-saveItems").on('click', function () {
    var saveButton = $(this);
    var cartID = saveButton.closest('tr').find(".cartProduct").val();
    var itemsVal = saveButton.closest('tr').find(".cantidad").val();

    var data = {
        id: cartID,
        numItems: itemsVal
    };
    
    $.ajax({
        url: './API/cartsAPI.php?action=update',
        method: 'POST',
        data: data,
        success: function (result) {
            alert(result)
            loadCartItems();
            window.location.href = "cart.php";
        },
        error: function (xhr, status, error) {
            // Handle errors here
            console.log('Error:', error);
        }
    });
});

//#endregion