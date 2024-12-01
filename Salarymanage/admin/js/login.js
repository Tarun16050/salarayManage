<script>
    function generateRandomNumber() {
        var randomNumber = Math.floor(Math.random() * 9000) + 1000;
        return randomNumber;
    }

    function updateCaptcha() {
        var captchaValue = generateRandomNumber();
        var captchaElement = document.getElementById("chapchaval");
        var inputElement = document.getElementById("number");

        captchaElement.innerHTML = captchaValue;
        inputElement.placeholder = "Enter Captcha: " + captchaValue;
        inputElement.setAttribute("data-captcha-value", captchaValue);
    }

    // Validate form fields
    function validateForm() {
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var captcha = document.getElementById("number").value;
        var captchaValue = document.getElementById("number").getAttribute("data-captcha-value");

        if (email.trim() === "" || password.trim() === "" || captcha.trim() === "") {
            document.getElementById("error_msg").innerHTML = "Please fill in all fields.";
            return false;
        } else if (captcha !== captchaValue) {
            document.getElementById("error_msg").innerHTML = "Captcha does not match!";
            return false;
        }
        return true;
    }

    // Attach form submission event listener
    document.getElementById("grivence-login").addEventListener("submit", function(event) {
        if (!validateForm()) {
            event.preventDefault(); // Prevent form submission if validation fails
        }
    });

    // Update captcha on page load
    window.onload = function() {
        updateCaptcha();
    };

    // Blur event listener for captcha input
    document.getElementById("number").addEventListener("blur", function(event) {
        var inputElement = event.target;
        var enteredValue = inputElement.value.trim();
        var captchaValue = inputElement.getAttribute("data-captcha-value");
        if (enteredValue !== captchaValue) {
            alert("Captcha does not match!");
        }
    });
</script>
