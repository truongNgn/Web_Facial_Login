<?php
session_start();
header('Content-Type: application/json');

// Check if the username is stored in the session
if (isset($_SESSION['username'])) {
    echo json_encode(['success' => true, 'username' => $_SESSION['username']]);
} else {
    echo json_encode(['success' => false, 'message' => 'User not logged in.']);
}
?>
