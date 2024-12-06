<?php
header('Content-Type: application/json');

// Database credentials
$host = "localhost";
$dbname = "face_recognition";
$username = "root";
$password = "";

// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

// Parse incoming JSON
$input = json_decode(file_get_contents("php://input"), true);

if (isset($input['name'])) {
    $name = $conn->real_escape_string($input['name']);

    // Check if username exists
    $query = "SELECT * FROM users WHERE name='$name'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        echo json_encode(['success' => false, 'message' => 'Username already exists']);
    } else {
        echo json_encode(['success' => true, 'message' => 'Username is available']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}

$conn->close();
?>
