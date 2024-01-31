document.addEventListener('DOMContentLoaded', function () {
    const passwordInput = document.getElementById('password');
    const strengthLabel = document.getElementById('strength-label');

    passwordInput.addEventListener('input', function () {
        const passwordValue = passwordInput.value.trim(); // Trim whitespace

        if (passwordValue === '') {
            // Clear the strength label when the password is empty
            clearPasswordStrength(strengthLabel);
        } else {
            const score = calculatePasswordStrength(passwordValue);

            // Update the password strength label and style
            updatePasswordStrength(score, strengthLabel);
        }
    });

    // Password strength calculation function
    function calculatePasswordStrength(passwordValue) {
        // Your password strength logic here
        // For simplicity, let's consider length as the primary factor
        if (passwordValue.length >= 8) {
            return 2; // Strong password
        } else if (passwordValue.length >= 6) {
            return 1; // Medium password
        } else {
            return 0; // Weak password
        }
    }

    // Update the password strength label and style
    function updatePasswordStrength(score, label) {
        switch (score) {
            case 0:
                label.textContent = 'Weak';
                label.style.color = 'red';
                break;
            case 1:
                label.textContent = 'Medium';
                label.style.color = 'blue';
                break;
            case 2:
                label.textContent = 'Strong';
                label.style.color = 'green';
                break;
        }
    }

    // Clear the password strength label
    function clearPasswordStrength(label) {
        label.textContent = '';
        label.style.color = '';
    }
});


    // JavaScript for real-time validation (you can add your own validation logic)
    const registrationForm = document.getElementById('registration-form');
    const errorMessage = document.getElementById('error-message');

    registrationForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Prevent the form from submitting
        // Add your form validation and registration logic here
    });
