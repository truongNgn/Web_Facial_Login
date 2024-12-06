<?php
header('Content-Type: application/json');

// Database connection credentials
$host = "localhost";
$dbname = "face_recognition";
$username = "root";
$password = "";

// Connect to the database
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

// Parse JSON input
$input = json_decode(file_get_contents("php://input"), true);

if (isset($input['username']) && isset($input['password'])) {
    $username = $conn->real_escape_string($input['username']);
    $password = $conn->real_escape_string($input['password']);

    // Query database for user
    $query = "SELECT * FROM users WHERE name = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $storedPassword = $user['password'];

        // Compare the provided password with the stored password
        if ($password === $storedPassword) {
            // Store descriptor in session for later face verification
            session_start();
            $_SESSION['storedDescriptor'] = $user['descriptor'];
            $_SESSION['username'] = $username; // Optional: Store username in session for future use
            
            echo json_encode(['success' => true, 'message' => 'Password correct. Proceed to face verification.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid password.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input. Username and password are required.']);
}

$conn->close();
?>
