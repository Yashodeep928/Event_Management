<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="container-center">
    <div class="form-container">
        <h2 class="header">Signup</h2>
        <form action="register.php" method="POST">
            <input class="border w-full p-2 mb-4" type="text" name="username" placeholder="Username" required>
            <input class="border w-full p-2 mb-4" type="email" name="email" placeholder="Email" required>
            <input class="border w-full p-2 mb-4" type="password" name="password" placeholder="Password" required>
            <select class="border w-full p-2 mb-4" name="role" required>
                <option value="organizer">Organizer</option>
                <option value="attendee">Attendee</option>
            </select>
            <button type="submit" class="btn w-full">Register</button>
        </form>
        <p class="mt-4">Already have an account? <a href="loginhtml.php" class="link">Login</a></p>
    </div>
</body>
</html>
