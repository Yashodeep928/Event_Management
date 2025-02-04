<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth/loginhtml.php");
    exit();
}

require '../config/db.php';

$query = $pdo->query("SELECT * FROM events");
$events = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-8">
    <h1 class="text-2xl font-bold">User Dashboard</h1>
    <ul>
        <?php foreach ($events as $event): ?>
            <li><?= htmlspecialchars($event['title']) ?> - <?= $event['date'] ?> at <?= $event['location'] ?></li>
        <?php endforeach; ?>
    </ul>
    <a href="../auth/logout.php" class="btn bg-red-500 text-white px-4 py-2 rounded">Logout</a>
</body>
</html>
