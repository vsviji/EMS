<?php
// Database connection parameters
$host = "localhost"; // Often localhost
$user = "root";
$password = "";
$database = "event_mgmt";

// Create a database connection
$conn = new mysqli($host, $user, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert application data into the database
$name = htmlspecialchars($_POST['name']);
$phone = htmlspecialchars($_POST['phone']);
$department = htmlspecialchars($_POST['department']);
$year = htmlspecialchars($_POST['year']);

$sql = "INSERT INTO applications (name, phone, department, year) VALUES ('$name', '$phone', '$department', $year)";

if ($conn->query($sql) === TRUE) {
    echo "Application information stored successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Confirmation</title>
    <!-- You can include Bootstrap or any other CSS stylesheets here -->
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 20px;
            background-color: #f4f4f4;
            color: #333;
            width: 45%; 
            float: left; 
            margin-right: 20px;
        }
        .confirmation {
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #007bff;
        }
    </style>
</head>
<body>

    <h1>Application Confirmation</h1>

    <div class="confirmation">
        <h2>Thank you for applying!</h2>
        <p>Your application details:</p>

        <ul>
            <li><strong>Name:</strong> <?php echo htmlspecialchars($_POST['name']); ?></li>
            <li><strong>Phone No:</strong> <?php echo htmlspecialchars($_POST['phone']); ?></li>
            <li><strong>Department:</strong> <?php echo htmlspecialchars($_POST['department']); ?></li>
            <li><strong>Year:</strong> <?php echo htmlspecialchars($_POST['year']); ?></li>
        </ul>
    </div>

</body>
</html>
