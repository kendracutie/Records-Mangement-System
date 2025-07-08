<?php
session_start();

// Check if the username is set in the session (logged in)
if (!isset($_SESSION['username'])) {
    echo 'error'; // User is not logged in
    exit;
}

// Database connection
$host = 'localhost'; // Your database host
$dbname = 'stjohnmaryvianney'; // Your database name
$username = 'root'; // Your database username
$password = ''; // Your database password

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the password from the request
$inputPassword = $_POST['password'];

// Get the logged-in admin's username from the session
$loggedInUsername = $_SESSION['username'];

// Fetch the password hash from the database for the logged-in username
$sql = "SELECT password FROM admins WHERE username = ?"; // Query based on the logged-in username
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $loggedInUsername); // Bind the logged-in username to the query
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $adminPasswordHash = $row['password']; // Assuming the password is hashed

    // Verify the input password with the stored password hash
    if (password_verify($inputPassword, $adminPasswordHash)) {
        // Password is correct
        echo 'success';
    } else {
        // Password is incorrect
        echo 'error';
    }
} else {
    // If no admin found, respond with an error
    echo 'error';
}

// Close the prepared statement and the database connection
$stmt->close();
$conn->close();
?>
