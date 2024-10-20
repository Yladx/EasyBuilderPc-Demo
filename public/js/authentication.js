$(document).ready(function() {
    // Disable the button initially
    $("#loginButton").prop("disabled", true);

    // Validate form on submit
    $("#loginForm").validate({
        rules: {
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 5,
                maxlength: 9
            }
        },
        messages: {
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address"
            },
            password: {
                required: "Please enter your password",
                minlength: "Password must be at least 5 characters",
                maxlength: "Password must not exceed 9 characters"
            }
        },
        // Enable the button if the form is valid
        submitHandler: function(form) {
            $("#loginButton").prop("disabled", false);
            form.submit();
        }
    });

    // Monitor input fields for changes
    $("#email, #password").on('input', function() {
        // Check if the form is valid
        if ($("#loginForm").valid()) {
            $("#loginButton").prop("disabled", false);
        } else {
            $("#loginButton").prop("disabled", true);
        }
    });


    $("#registerButton").prop("disabled", true);

    // Validate form on submit
    $("#registerForm").validate({
        rules: {
            firstName: {
                required: true
            },
            lastName: {
                required: true
            },
            username: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            rpassword: {
                required: true,
                minlength: 5,
                maxlength: 9,
                   },
                   rpassword_confirmation: {
                required: true,
                equalTo: "#rpassword" // Ensures confirm password matches password
            }
        },
        messages: {
            firstName: {
                required: "Please enter your first name"
            },
            lastName: {
                required: "Please enter your last name"
            },
            username: {
                required: "Please enter a username"
            },
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address"
            },
            rpassword: {
                required: "Please enter your password",
                minlength: "Password must be at least 5 characters",
                maxlength: "Password must not exceed 9 characters",
                           },
                           rpassword_confirmation: {
                required: "Please confirm your password",
                equalTo: "Passwords do not match"
            }
        },
        // Enable the button if the form is valid
        submitHandler: function(form) {
            $("#registerButton").prop("disabled", false);
            form.submit();
        }
    });

    // Monitor input fields for changes
    $("#firstName, #lastName, #username, #email, #rpassword, #confirmPassword").on('input', function() {
        // Check if the form is valid
        if ($("#registerForm").valid()) {
            $("#registerButton").prop("disabled", false);
        } else {
            $("#registerButton").prop("disabled", true);
        }
    });


    });

