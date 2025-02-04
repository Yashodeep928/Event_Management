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
        <h2 class="header text-center">Admin Dashboard</h2>
        <h3 class="text-xl font-semibold mb-4">Add Event</h3>
        <form action="add_event.php" id="addevent" method="POST" class="form-container">
            <input class="border w-full p-2 mb-4" type="text" id="title" name="title" placeholder="Event Title" required>
            <textarea class="border w-full p-2 mb-4" name="description" id="description" placeholder="Event Description" required></textarea>
            <input class="border w-full p-2 mb-4" type="date" id="date" name="date" required>
            <input class="border w-full p-2 mb-4" type="time" id="time" name="time" required>
            <input class="border w-full p-2 mb-4" type="text" id="location" name="location" placeholder="Event Location" required>
            <button type="submit" class="btn w-full">Add Event</button>
        </form>

        <h3 class="text-xl font-semibold mt-8 mb-4">Existing Events</h3>
        <ul id="event-list" class="list-disc ml-5">
            <?php foreach ($events as $event): ?>
                <li class="mb-2 flex justify-between items-center bg-white p-4 shadow rounded">
                    <div>
                        <strong><?= htmlspecialchars($event['title']) ?></strong> - <?= $event['date'] ?> at <?= htmlspecialchars($event['location']) ?>
                    </div>
                    <button class="text-red-500 hover:underline delete-event" data-id="<?= $event['id'] ?>">Delete</button>
                </li>
            <?php endforeach; ?>
        </ul>

        <a href="../auth/logout.php" class="btn mt-4">Logout</a>
    </div>
<script>
    $(document).ready(function() {
        $("#addevent").click(function(e) {

            e.preventDefault();

               let eventData = {
                title: $("#title").val(),
                description: $("#description").val(),
                date: $("#date").val(),
                time: $("#time").val(),
                location: $("#location").val()
               }

            $.ajax({
                url: "add_event.php",
                method: "POST",
                data: eventData,
                success: function(response) {
                    if (response.status === 200) {
                        console.log(response.message);
                        alert("Event added successfully!");
                    } else {
                        alert("Failed to add event.", response.error);
                    }
                }
            });
   
        });


        $("#delete-event").click(function(e) {
            e.preventDefault();

            let eventId = $(this).data("id");
                let element = $(this).parent();

                $.ajax({
                    url: "delete_event.php",
                    method: "POST",
                    data: { event_id: eventId },
                    success: function(response) {
                        let res = JSON.parse(response);
                        if (res.status === 200) {
                            element.remove();
                            alert("Event deleted successfully!");
                        } else {
                            alert("Failed to delete event.");
                        }
                    }

                });

        })
    });
 
</script>

</body>
</html>
