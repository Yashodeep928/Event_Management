<?php
session_start();
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $name = trim($_POST['name']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);

        // Hash the password before storing
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Check if email already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            echo json_encode(['status' => 409, 'error' => 'Email already exists!']);
            exit();
        }

        // Default role as 'user'
        $query = "INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'user')";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$name, $email, $hashedPassword]);

        echo json_encode(['status' => 200, 'message' => 'Registration successful!']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 500, 'error' => $e->getMessage()]);
    }
}
?>
