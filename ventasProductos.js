$(document).ready(function () {
    var actualDate = new Date().toISOString().split('T')[0];
    alert(actualDate);
    document.getElementById("endDate").value = actualDate;
})

//#region formato
function validateDate() {

    var regexFecha = /^\d{4}-\d{2}-\d{2}$/;

    if (!regexFecha.test(fecha)) {
        alert("Formato de fecha incorrecto. Utiliza el formato YYYY-MM-DD.");
    } else {
        alert("Fecha válida.");
    }
}

//#endregion