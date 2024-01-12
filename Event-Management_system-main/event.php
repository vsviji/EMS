<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Events - Event Management System</title>
    <!-- You can include Bootstrap or any other CSS stylesheets here -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .event {
            margin-bottom: 20px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 45%;
            float: left;
            margin-right: 20px;
        }
        h2 {
            color: #007bff;
        }
        p {
            margin-bottom: 10px;
        }
        .apply-btn {
            background-color: #28a745;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .add-event-btn {
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px; /* Increased padding for a more attractive look */
            border: none;
            border-radius: 4px;
            cursor: pointer;
            position: absolute;
            top: 20px;
            right: 20px; /* Positioned in the top right corner */
        }
        .add-event-btn:hover {
            background-color: #0056b3;
        }
        .apply-form {
            display: none;
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        input[type="search"] {
            width: 900px; /* Adjust the width as needed */
            padding: 8px;
            margin-bottom: 10px auto !important;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
<button class="add-event-btn" onclick="toggleAddEventForm()"><a href="addevent.php">Add Event</a></button>
<h1 style="text-align: center">Events</h1>
<!-- Search Bar -->
<input type="search" id="eventSearch" placeholder="Search events" oninput="filterEvents()">

<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "event_mgmt";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch events from the database
$sql = "SELECT * FROM events";
$result = $conn->query($sql);

// Display events
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        ?>
        <div class="event">
            <h2><?php echo $row["eventName"]; ?></h2>
            <p><strong>Description:</strong> <?php echo $row["eventDescription"]; ?></p>
            
            <p><strong>Location:</strong> <?php echo $row["eventLocation"]; ?></p>

            <p><strong>Event Organizer Name:</strong> <?php echo $row["eventOrganizer"]; ?></p>

            <p><strong>Added By:</strong> <?php echo $row["organizer"]; ?></p>
            <button class="apply-btn" onclick="toggleApplyForm('apply-form-<?php echo $row["eventId"]; ?>')">Apply</button>
            <div class="apply-form" id="apply-form-<?php echo $row["eventId"]; ?>">
                <form method="post" action="apply.php">
                    <label for="name">Name:</label>
                    <input type="text" name="name" required><br>

                    <label for="phone">Phone No:</label>
                    <input type="tel" name="phone" required><br>

                    <label for="department">Department:</label>
                    <input type="text" name="department" required><br>

                    <label for="year">Year:</label>
                    <input type="text" name="year" required><br>

                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
        <?php
    }
} else {
    echo "No events found.";
}

// Close the database connection
$conn->close();
?>

<script>
    function toggleApplyForm(formId) {
        var form = document.getElementById(formId);
        form.style.display = form.style.display === 'none' ? 'block' : 'none';
    }

    function filterEvents() {
        var searchInput = document.getElementById('eventSearch').value.toLowerCase();
        var events = document.querySelectorAll('.event');

        events.forEach(function (event) {
            var eventName = event.querySelector('h2').innerText.toLowerCase();
            if (eventName.includes(searchInput)) {
                event.style.display = 'block';
            } else {
                event.style.display = 'none';
            }
        });
    }
</script>

</body>
</html>
