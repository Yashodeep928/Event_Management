<?php

session_start(); // ✅ Start session at the beginning
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $location = $_POST['location'];
        $created_by = $_SESSION['user_id']; // Get user ID from session

        $insertquery = "INSERT INTO events (title, description, date, time, location, created_by) 
                        VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($insertquery);
        $stmt->execute([$title, $description, $date, $time, $location, $created_by]);

        // ✅ Remove print_r() and directly send JSON response
        echo json_encode(['status' => 200, 'message' => 'Event added successfully', 'event' => [
            'id' => $pdo->lastInsertId(),
            'title' => $title,
            'date' => $date,
            'location' => $location
        ]]);
        exit();
    } catch (PDOException $e) {
        echo json_encode(['status' => 500, 'error' => "Error: " . $e->getMessage()]);
        exit();
    }
}
?>













































// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


// require '../config/db.php';

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     try {
//         $title = $_POST['title'];
//         $description = $_POST['description'];
//         $date = $_POST['date'];
//         $time = $_POST['time'];
//         $location = $_POST['location'];
//         $created_by = $_SESSION['user_id']; 


//         $insertquery = "INSERT INTO events (title, description, date, time, location, created_by) 
//                         VALUES (?, ?, ?, ?, ?, ?)";

//         $stmt = $pdo->prepare($insertquery);

//         $stmt->execute([$title, $description, $date, $time, $location,$created_by]);

//         echo "<pre>";
//     print_r($stmt->errorInfo()); 
//     echo "</pre>";

//         echo json_encode(['status' => 200, 'message' => 'Event added successfully']);
        
//         exit();
//     } catch (PDOException $e) {
//         echo json_encode(['status' => 500, 'error' => "Error: " . $e->getMessage()]);
//         exit();
//     }
// }

// Fetch events when a GET request is made
// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     try {
//         $selectquery = "SELECT id, title, description, date, time, location FROM events";
//         $stmt = $pdo->prepare($selectquery);
//         $stmt->execute();
//         $events = $stmt->fetchAll(PDO::FETCH_ASSOC);

//         echo json_encode(['status' => 200, 'events' => $events]);
//         exit();
//     } catch (PDOException $e) {
//         echo json_encode(['status' => 500, 'error' => "Error: " . $e->getMessage()]);
//         exit();
//     }
// }

