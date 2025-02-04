<?php
session_start();
include './config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $query = "SELECT user_id, password FROM register WHERE username = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if ($password === $user['password']) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $username;

                $insertQuery = "INSERT INTO login (user_id, username, password) VALUES (?, ?, ?)";
                $insertStmt = $pdo->prepare($insertQuery);
                $insertStmt->execute([$user['user_id'], $username, $password]);

                echo json_encode(['status' => 200, 'success' => 'Login successful!']);
            } else {
                echo json_encode(['status' => 401, 'error' => 'Invalid password!']);
            }
        } else {
            echo json_encode(['status' => 401, 'error' => 'Invalid username or password!']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 500, 'error' => "Error: " . $e->getMessage()]);
    }
}
?>
