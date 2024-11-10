$(document).ready(function() {
    $("#loginForm").submit(function(e) {
        e.preventDefault(); // Prevent form from submitting normally

        // Collect form data
        let username = $("#username").val();
        let password = $("#password").val();

        // AJAX request
        $.ajax({
            type: "POST",
            url: "login.php",
            data: { username: username, password: password },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    window.location.href = "admin/dashboard.php"; // Redirect on success
                } else {
                    $("#error").removeClass("hidden").text(response.message); // Show error message
                }
            },
            error: function() {
                $("#error").removeClass("hidden").text("An error occurred. Please try again.");
            }
        });
    });
});
