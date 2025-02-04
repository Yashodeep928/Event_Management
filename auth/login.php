<?php
session_start();
require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    try {
        // Fetch user by email
        $query = "SELECT id, name, password, role FROM users WHERE email = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['role'] = $user['role'];
            // $redirectPath = '';

            // Fix: Ensure correct redirect path
            $redirectPath = ($user['role'] === 'admin') ? '../admin/dashboard.php' : '../user/dashboard.php';

            // if($user['role'] == 'admin') {
            //     // $redirectPath = '../user/dashboard.php';
            //     $redirectPath = 'admin';
            //     // echo "admin role";
            // } else {
            //     // $redirectPath = '../user/dashboard.php';
            //     $redirectPath = 'user';
            //     // echo "user role";
            // }

            echo json_encode(['status' => 200, 'redirect' => $redirectPath]);
        } else {
            echo json_encode(['status' => 401, 'error' => 'Invalid email or password!']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 500, 'error' => "Database Error: " . $e->getMessage()]);
    }
}
?>
