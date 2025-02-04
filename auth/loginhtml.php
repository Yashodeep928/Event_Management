<?php
session_start();

// Destroy all sessions
session_unset();
session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 flex justify-center items-center h-screen">
    <div class="bg-white p-6 rounded shadow-md w-96">
        <h2 class="text-2xl font-bold mb-4">Login</h2>
        
        <p id="error-message" class="text-red-500 mb-2 hidden"></p>

        <form id="login-form">
            <label class="block mb-2">Email:</label>
            <input type="email" id="email" name="email" class="border w-full p-2 mb-4" required>

            <label class="block mb-2">Password:</label>
            <input type="password" id="password" name="password" class="border w-full p-2 mb-4" required>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded w-full">Login</button>
        </form>
    </div>

    <script>
        $(document).ready(function () {
            $("#login-form").on("submit", function (e) {
                e.preventDefault();

                let email = $("#email").val();
                let password = $("#password").val();

                $.ajax({
                    url: "login.php",
                    method: "POST",
                    data: { email: email, password: password },
                    dataType: "json",
                    success: function (response) {
                        if (response.status === 200) {
                            window.location.href = response.redirect;
                        } else {
                            $("#error-message").text(response.error).removeClass("hidden");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.log("AJAX Error: " + error);
                    }
                });
            });
        });
    </script>
</body>
</html>
