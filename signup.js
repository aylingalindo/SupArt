$(document).ready(function () {
    $("#signup").submit(function (event) {
        event.preventDefault(); // Prevent the default form submission
        alert("working")

        var formData = $(this).serializeArray();
        formData.push({ name: 'action', value: 'insert' });
        console.log(formData);
        alert(formData);
        // Send form data to the server using AJAX with jQuery
        $.ajax({
            type: "POST",
            url: "/API/usersAPI.php",
            data: $.param(formData), 
            success: function (response) {
                window.location.href = 'index.php';
                // Handle the server's response
                $("#result").html(response);
            },
            error: function (xhr, status, error) {
                console.log("Error: " + error);
            }
        });
    });
})