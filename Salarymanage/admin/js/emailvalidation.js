$(document).ready(function() {
    // Initialize form validation
    $("#admin_form").validate({
        rules: {
            email: {
                required: true,
                email: true
            }
        },
        messages: {
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address"
            }
        }
    });

    // Check email availability on input change
    $("#email").on("input", function() {
        var email = $(this).val();

        // Check email availability via AJAX
        $.ajax({
            type: "POST",
            url: "admin_email.php",
            data: { email: email },
            success: function(response) {
                if (response == "exists") {
                    $("#errors_Email").text("This email is already registered.");
                } else {
                    $("#errors_Email").text("");
                }
            }
        });
    });
});

