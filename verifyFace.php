<?php
header('Content-Type: application/json');
session_start();

// Database connection credentials
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

// Parse JSON input
$input = json_decode(file_get_contents("php://input"), true);

if (isset($input['descriptor']) && isset($_SESSION['storedDescriptor'])) {
    $inputDescriptor = $input['descriptor'];
    $storedDescriptor = json_decode($_SESSION['storedDescriptor'], true);

    // Function to calculate cosine similarity
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

    // Compare input descriptor with the stored descriptor
    $similarity = cosineSimilarity($inputDescriptor, $storedDescriptor);

    // Set a strict threshold for face similarity 
    if ($similarity > 0.95) {
        echo json_encode(['success' => true, 'message' => 'Face verification successful!']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Face not recognized.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input or session expired.']);
}

$conn->close();
?>
    