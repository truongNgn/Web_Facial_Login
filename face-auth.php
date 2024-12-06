<?php
header('Content-Type: application/json');

$host = "localhost";
$dbname = "face_auth";
$username = "root";
$password = "";

// Connect to database
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Database connection failed']));
}

$input = json_decode(file_get_contents("php://input"), true);

if (isset($input['descriptor'])) {
    $inputDescriptor = $input['descriptor'];

    // Retrieve user's face descriptor from database
    $query = "SELECT descriptor FROM users WHERE name='$_SESSION[account]'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $storedDescriptor = json_decode($user['descriptor'], true);

        // Compare descriptors
        function cosineSimilarity($vecA, $vecB) {
            $dotProduct = 0.0;
            $normA = 0.0;
            $normB = 0.0;

            for ($i = 0; $i < count($vecA); $i++) {
                $dotProduct += $vecA[$i] * $vecB[$i];
                $normA += $vecA[$i] ** 2;
                $normB += $vecB[$i] ** 2;
            }

            return $dotProduct / (sqrt($normA) * sqrt($normB));
        }

        $similarity = cosineSimilarity($inputDescriptor, $storedDescriptor);

        if ($similarity > 0.9) {
            echo json_encode(['success' => true, 'message' => 'Face verified']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Face not recognized']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'User not found']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}

$conn->close();
?>
