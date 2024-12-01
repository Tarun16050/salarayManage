
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('admin_form');
    
    form.addEventListener('submit', function (event) {
        let valid = true;

        const errors = {
            firstName: document.getElementById('errors_first_name'),
            lastName: document.getElementById('errors_last_name'),
            email: document.getElementById('errors_email'),
            phone: document.getElementById('errors_phone'),
            password: document.getElementById('errors_password'),
            confirmPassword: document.getElementById('errors_confirm_password')
        };

        // Clear previous errors
        Object.values(errors).forEach(error => error.textContent = '');

        // Simple Validation Checks
        const firstName = document.getElementById('first_name').value.trim();
        if (!firstName) {
            errors.firstName.textContent = 'First Name is required.';
            valid = false;
        }

        const lastName = document.getElementById('last_name').value.trim();
        if (!lastName) {
            errors.lastName.textContent = 'Last Name is required.';
            valid = false;
        }

        const email = document.getElementById('email').value.trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!email || !emailPattern.test(email)) {
            errors.email.textContent = 'A valid email is required.';
            valid = false;
        }

        const phone = document.getElementById('phone').value.trim();
        const phonePattern = /^\d{10}$/; // Example pattern: 10-digit phone number
        if (!phone || !phonePattern.test(phone)) {
            errors.phone.textContent = 'A valid phone number (10 digits) is required.';
            valid = false;
        }

        const password = document.getElementById('password').value.trim();
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
        if (!password || !passwordPattern.test(password)) {
            errors.password.textContent = 'Password must be at least 6 characters long, with one uppercase letter, one lowercase letter, one number, and one special character.';
            valid = false;
        }

        const confirmPassword = document.getElementById('confirm_password').value.trim();
        if (!confirmPassword) {
            errors.confirmPassword.textContent = 'Please confirm your password.';
            valid = false;
        } else if (password !== confirmPassword) {
            errors.confirmPassword.textContent = 'Passwords do not match.';
            valid = false;
        }
        // If there are any validation errors, prevent form submission
        if (!valid) {
            event.preventDefault();
        }
    });
    //email check in database 
    const emailInput = document.getElementById('email');
    const emailError = document.getElementById('errors_email');

    emailInput.addEventListener('input', async function () {
        const email = this.value.trim();
        if (email) {
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (emailPattern.test(email)) {
                try {
                    const response = await fetch('check_email.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: new URLSearchParams({ email })
                    });
    
                    const result = await response.json();
                    if (result.exists) {
                        emailError.textContent = 'Email is already taken.';
                    } else {
                        emailError.textContent = '';
                    }
                } catch (error) {
                    console.error('Error checking email:', error);
                    emailError.textContent = 'Error checking email.';
                }
    
            } else {
                emailError.textContent = '';
            }
        } else {
            emailError.textContent = '';
        }
    });
    //End email check in databse
    //Phone number check in database
    const phoneInput = document.getElementById('phone');
const phoneError = document.getElementById('errors_phone');

phoneInput.addEventListener('input', async function () {
    const phone = this.value.trim();
    if (phone) {
        const phonePattern = /^\d{10}$/;
        if (phonePattern.test(phone)) {
            try {
                const response = await fetch('phone_number_check.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: new URLSearchParams({ phone })
                });

                const result = await response.json();
                if (result.exists) {
                    phoneError.textContent = 'Phone number is already taken.';
                } else {
                    phoneError.textContent = '';
                }
            } catch (error) {
                console.error('Error checking phone number:', error);
                phoneError.textContent = 'Error checking phone number.';
            }
        } else {
            phoneError.textContent = '';
        }
    } else {
        phoneError.textContent = '';
    }
});

    // End Phone number check in database 

    // Add input event listeners to clear errors when input becomes valid
    const inputs = {
        firstName: document.getElementById('first_name'),
        lastName: document.getElementById('last_name'),
        email: document.getElementById('email'),
        phone: document.getElementById('phone'),
        password: document.getElementById('password'),
        confirmPassword: document.getElementById('confirm_password')
    };

    inputs.firstName.addEventListener('input', function () {
        if (this.value.trim()) {
            document.getElementById('errors_first_name').textContent = '';
        }
    });

    inputs.lastName.addEventListener('input', function () {
        if (this.value.trim()) {
            document.getElementById('errors_last_name').textContent = '';
        }
    });

    inputs.email.addEventListener('input', function () {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailPattern.test(this.value.trim())) {
            document.getElementById('errors_email').textContent = '';
        }
    });

    inputs.phone.addEventListener('input', function () {
        const phonePattern = /^\d{10}$/;
        if (phonePattern.test(this.value.trim())) {
            document.getElementById('errors_phone').textContent = '';
        }
        else{
            document.getElementById('errors_phone').textContent = 'A valid phone number (10 digits) is required.';
        }
    });

    inputs.password.addEventListener('input', function () {
        const password = this.value.trim();
        const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/;
        if (passwordPattern.test(password)) {
            document.getElementById('errors_password').textContent = '';
        }
    });

    inputs.confirmPassword.addEventListener('input', function () {
        const password = document.getElementById('password').value.trim();
        if (this.value.trim() === password) {
            document.getElementById('errors_confirm_password').textContent = '';
        }
    });
});



