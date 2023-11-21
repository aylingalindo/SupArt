$(document).ready(function () {
    var actualDate = new Date().toISOString().split('T')[0];
    document.getElementById("endDate").value = actualDate;
});

//#region formato
function validateDate() {
    // Assuming 'fecha' is the value of an input element
    var fecha = document.getElementById("yourInputId").value;
    
    var regexFecha = /^\d{4}-\d{2}-\d{2}$/;

    if (!regexFecha.test(fecha)) {
        alert("Formato de fecha incorrecto. Utiliza el formato YYYY-MM-DD.");
    } else {
        alert("Fecha válida.");
    }
}
//#endregion

$(document).ready(function() {
    $("#Cat").change(function() {
        // Your code for handling the change event
        // Add your logic here
    });
});
