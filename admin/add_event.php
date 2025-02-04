<?php

include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $location = $_POST['location'];

        $insertquery = "INSERT INTO events (title, description, date, time, location) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($insertquery);

        // ✅ Correctly binding values to placeholders
        $stmt->execute([$title, $description, $date, $time, $location]);

        echo json_encode(['status' => 200, 'message' => 'Event added successfully']);
        exit();
    } catch (PDOException $e) {
        echo json_encode(['status' => 500, 'error' => "Error: " . $e->getMessage()]);
        exit();
    }
}

?>
