<?php
session_start();
require '../config/db.php';

// Check if user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../auth/loginhtml.php");
    exit();
}

// Fetch events from the database
try {
    $stmt = $pdo->query("SELECT id, title, description, date, time, location, created_by FROM events");
    $events = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="container mx-auto">
        <h2 class="text-center text-2xl font-bold mb-4">Admin Dashboard</h2>

        <!-- Add Event Form -->
        <h3 class="text-xl font-semibold mb-4">Add Event</h3>
        <form id="addevent" method="POST" class="bg-white p-6 shadow rounded">
            <input class="border w-full p-2 mb-4" type="text" id="title" name="title" placeholder="Event Title" required>
            <textarea class="border w-full p-2 mb-4" name="description" id="description" placeholder="Event Description" required></textarea>
            <input class="border w-full p-2 mb-4" type="date" id="date" name="date" required>
            <input class="border w-full p-2 mb-4" type="time" id="time" name="time" required>
            <input class="border w-full p-2 mb-4" type="text" id="location" name="location" placeholder="Event Location" required>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 w-full rounded hover:bg-blue-700">Add Event</button>
        </form>

        <!-- Existing Events -->
        <h3 class="text-xl font-semibold mt-8 mb-4">Existing Events</h3>
        <ul id="event-list" class="list-disc ml-5">
            <?php foreach ($events as $event): ?>
                <li class="mb-2 flex justify-between items-center bg-white p-4 shadow rounded">
                    <div>
                        <strong><?= htmlspecialchars($event['title']) ?></strong> - <?= htmlspecialchars($event['date']) ?> at <?= htmlspecialchars($event['location']) ?>
                    </div>
                    <button class="text-red-500 hover:underline delete-event" data-id="<?= $event['id'] ?>">Delete</button>
                </li>
            <?php endforeach; ?>
        </ul>

        <a href="../auth/logout.php" class="mt-4 block text-center text-red-500 hover:underline">Logout</a>
    </div>

    <script>
        $(document).ready(function() {
            // Add event
            $("#addevent").submit(function(e) {
                e.preventDefault();

                let eventData = {
                    title: $("#title").val(),
                    description: $("#description").val(),
                    date: $("#date").val(),
                    time: $("#time").val(),
                    location: $("#location").val()
                };

                $.ajax({
                    url: "add_event.php",
                    method: "POST",
                    data: eventData,
                    dataType: "json",
                    success: function(response) {
                        if (response.status === 200) {
                            alert("Event added successfully!");
                            location.reload();
                        } else {
                            alert("Failed to add event: " + response.error);
                        }
                    },
                    error: function() {
                        alert("Error in adding event.");
                    }
                });
            });

            // Delete event
            $(document).on("click", ".delete-event", function() {
                let eventId = $(this).data("id");
                let element = $(this).closest("li");

                if (!confirm("Are you sure you want to delete this event?")) return;

                $.ajax({
                    url: "delete_event.php",
                    method: "POST",
                    data: { event_id: eventId },
                    dataType: "json",
                    success: function(response) {
                        if (response.status === 200) {
                            element.remove();
                            alert("Event deleted successfully!");
                        } else {
                            alert("Failed to delete event.");
                        }
                    },
                    error: function() {
                        alert("Error deleting event.");
                    }
                });
            });
        });
    </script>
</body>
</html>
