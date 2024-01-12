<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event - Event Management System</title>
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
        form {
            width: 50%;
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        input, textarea, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            padding: 10px 16px;
            border: none;
            border-radius: 4px;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center">Add Event</h1>

    <form method="post" action="process_event.php">
        <label for="eventName">Event Name:</label>
        <input type="text" name="eventName" required>

        <label for="eventDescription">Event Description:</label>
        <textarea name="eventDescription" rows="4" required></textarea>

        <label for="eventLocation">Event Location:</label>
        <input type="text" name="eventLocation" required>

        <label for="eventOrganizer">Event Organizer Name:</label>
        <input type="text" name="eventOrganizer" required>

        <label for="organizer">Event Organizer:</label>
        <select name="organizer" required>
            <option value="select one">Select one</option>
            <option value="student">Student</option>
            <option value="faculty">Faculty</option>
        </select>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
