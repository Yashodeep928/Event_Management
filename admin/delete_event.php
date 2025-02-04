<?php
session_start();
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $event_id = $_POST['event_id'];

        // Ensure only admin can delete events
        if ($_SESSION['role'] !== 'admin') {
            echo json_encode(['status' => 403, 'error' => 'Unauthorized']);
            exit();
        }

        $deletequery = "DELETE FROM events WHERE id = ?";
        $stmt = $pdo->prepare($deletequery);
        $stmt->execute([$event_id]);

        echo json_encode(['status' => 200, 'message' => 'Event deleted successfully']);
        exit();
    } catch (PDOException $e) {
        echo json_encode(['status' => 500, 'error' => $e->getMessage()]);
        exit();
    }
}
?>
