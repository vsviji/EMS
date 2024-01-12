<?php
// Connection to the database
$servername = "localhost";  
$username = "root";       
$password = "";      
$dbname = "event_mgmt";    

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventName = mysqli_real_escape_string($conn, $_POST["eventName"]);
    $eventDescription = mysqli_real_escape_string($conn, $_POST["eventDescription"]);
    $eventLocation = mysqli_real_escape_string($conn, $_POST["eventLocation"]);
    $eventOrganizer = mysqli_real_escape_string($conn, $_POST["eventOrganizer"]);
    $organizer = mysqli_real_escape_string($conn, $_POST["organizer"]);
    $sql = "INSERT INTO events (eventName, eventDescription, eventLocation, eventOrganizer, organizer) VALUES ('$eventName', '$eventDescription', '$eventLocation','$eventOrganizer','$organizer')";

    if ($conn->query($sql) === TRUE) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Event Submission Successful</title>
        </head>
        <body>
            <h1 style="color: green;">Congratulations!</h1>
            <p>Your event "<strong><?php echo $eventName; ?></strong>" has been submitted successfully!</p>
            <p>You will be redirected back to the event creation page shortly.</p>
            <!-- You can also add a redirection header after a few seconds -->
            <meta http-equiv="refresh" content="5;url=addevent.php">
        </body>
        </html>
        <?php
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
