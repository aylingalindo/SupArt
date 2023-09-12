var selectedButton;
$(document).ready(function () {
    alert("hola");
    $(".p-btnList").click(function () {
        selectedButton = $(this);
        $(".p-btnList").css({ "background-color": "#DAD2BC", 'box-shadow': ' inset -20px 0px 10px -20px #DAD2BC' });
        $(selectedButton).css({ "background-color": "#A99985", 'box-shadow': ' inset 0px 0px 0px 0px' });
        $(".profile-listInfo").css({ "background-color": "#A99985" });
    });
});