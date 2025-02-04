<?php
session_start();

// 🔥 Fix: Correct session variable name
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'user') {
    header("Location: ../auth/loginhtml.php");
    exit();
}

require '../config/db.php';

try {
    $query = $pdo->query("SELECT * FROM events ORDER BY date ASC"); // Order by date for better display
    $events = $query->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage()); // Better error handling
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-8 bg-gray-100">
    <h1 class="text-2xl font-bold mb-4">User Dashboard</h1>

    <?php if (empty($events)): ?>
        <p class="text-gray-600">No events available.</p>
    <?php else: ?>
        <ul class="bg-white p-4 rounded shadow-md">
            <?php foreach ($events as $event): ?>
                <li class="border-b py-2"><?= htmlspecialchars($event['title']) ?> - <?= htmlspecialchars($event['date']) ?> at <?= htmlspecialchars($event['location']) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <a href="../auth/logout.php" class="mt-4 inline-block bg-red-500 text-white px-4 py-2 rounded">Logout</a>
</body>
</html>
