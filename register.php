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

if (isset($input['name']) && isset($input['password']) && isset($input['descriptor'])) {
    $name = $conn->real_escape_string($input['name']);
    // $password = password_hash($conn->real_escape_string($input['password']), PASSWORD_BCRYPT);
    $password = $conn->real_escape_string($input['password']);
    $descriptor = json_encode($input['descriptor']);

    // Insert user into database
    $query = "INSERT INTO users (name, password, descriptor) VALUES ('$name', '$password', '$descriptor')";

    if ($conn->query($query) === TRUE) {
        echo json_encode(['success' => true, 'message' => 'User registered successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error registering user']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}

$conn->close();
?>
