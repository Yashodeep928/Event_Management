
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
    <link rel="stylesheet" href="style.css">


    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">
            <a href="index.html">Eventify</a>
        </div>
        <nav class="navbar">
            <a href="index.html">Home</a>
            <a href="events.html">Events</a>
            <a href="login.html">Login</a>
            <a href="register.html">Register</a>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <section class="hero">
            <h1>Welcome to Eventify</h1>
            <p>Manage your events with ease!</p>
            <a href="events.html" class="btn btn-primary">Explore Events</a>
        </section>

        <section class="cards">
            <!-- Dynamic Event Cards -->
            <div class="card">
                <h3>Event Title</h3>
                <p>Event Description</p>
                <a href="#" class="btn btn-secondary">View Details</a>
            </div>
            <div class="card">
                <h3>Another Event</h3>
                <p>Event Description</p>
                <a href="#" class="btn btn-secondary">View Details</a>

            </div>
        </section>
    </main>

    <a href="logout.php">Logout</a>


    <!-- Footer -->
    <footer class="footer">
        <p>&copy; 2025 Eventify. All rights reserved.</p>
    </footer>

    <script>
        // GSAP animation example
        gsap.from(".hero", { opacity: 0, y: 50, duration: 1 });
        gsap.from(".card", { opacity: 0, scale: 0.9, duration: 1, stagger: 0.3 });
    </script>
    <script src="app.js"></script>
</body>

</html>
