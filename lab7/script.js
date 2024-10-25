$(document).ready(function() {
    $('#registerForm').submit(function(e) {
        e.preventDefault();
        const username = $('input[name="username"]').val();
        const email = $('input[name="email"]').val();
        const password = $('input[name="password"]').val();
        const confirmPassword = $('input[name="confirm_password"]').val();

        if (password !== confirmPassword) {
            $('#error').text("Паролі не співпадають!");
            return;
        }

        $.ajax({
            url: 'server.php',
            method: 'POST',
            data: {
                action: 'register',
                username: username,
                email: email,
                password: password
            },
            success: function(response) {
                if (response === 'success') {
                    window.location.href = 'login.html';
                } else {
                    $('#error').text(response);
                }
            }
        });
    });

    $('#loginForm').submit(function(e) {
        e.preventDefault();
        const email = $('input[name="email"]').val();
        const password = $('input[name="password"]').val();

        $.ajax({
            url: 'server.php',
            method: 'POST',
            data: {
                action: 'login',
                email: email,
                password: password
            },
            success: function(response) {
                if (response === 'success') {
                    window.location.href = 'profile.html';
                } else {
                    $('#error').text(response);
                }
            }
        });
    });
});
