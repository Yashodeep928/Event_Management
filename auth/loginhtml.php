<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="container-center">
    <div class="form-container">
        <h2 class="header">Login</h2>
        <form action="login.php" method="POST">
            <input class="border w-full p-2 mb-4" type="email" name="email" placeholder="Email" required>
            <input class="border w-full p-2 mb-4" type="password" name="password" placeholder="Password" required>
            <button type="submit" class="btn w-full">Login</button>
        </form>
        <p class="mt-4">Don't have an account? <a href="registerhtml.php" class="link">Signup</a></p>
    </div>
</body>
</html>
