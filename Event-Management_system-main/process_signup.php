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

// Function to sanitize input data
function sanitizeData($data) {
    global $conn;
    return mysqli_real_escape_string($conn, $data);
}

// Process signup form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Extract form data
    $role = sanitizeData($_POST["role"]);
    $username = sanitizeData($_POST["username"]);
    $email = sanitizeData($_POST["email"]);
    $phone = sanitizeData($_POST["phone"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT); // Hash the password for security
    $location = sanitizeData($_POST["location"]);
    $qualification = sanitizeData($_POST["qualification"]);

    // SQL query based on role (student or faculty)
    $sql = "";
    if ($role === "student") {
        $sql = "INSERT INTO students (username, email, phone, password, location, qualification) VALUES ('$username', '$email', '$phone', '$password', '$location', '$qualification')";
    } elseif ($role === "faculty") {
        $sql = "INSERT INTO faculty (username, email, phone, password, location, qualification) VALUES ('$username', '$email', '$phone', '$password', '$location', '$qualification')";
    }

    // Execute the SQL query
    if ($conn->query($sql) === TRUE) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Signup Successful</title>
        </head>
        <body>
            <h1 style="color: green;">Congratulations!</h1>
            <p>Your signup as a <strong><?php echo ucfirst($role); ?></strong> is successful!</p>
            <p>You can now log in with your credentials.</p>
        </body>
        </html>
        <?php
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>
