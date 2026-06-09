<?php
require_once 'db_connect.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_feedback'])) {
    $rating = isset($_POST['rating']) ? (int)sanitize_input($_POST['rating']) : null;
    $name = isset($_POST['name']) ? sanitize_input($_POST['name']) : null;
    $email = isset($_POST['email']) ? sanitize_input($_POST['email']) : null;
    $type = isset($_POST['type']) ? sanitize_input($_POST['type']) : null;
    $message = isset($_POST['message']) ? sanitize_input($_POST['message']) : null;
    
    // Validate required fields
    if ($rating === null || $rating < 1 || $rating > 5) {
        echo json_encode(['success' => false, 'message' => 'Please select a valid rating (1-5).']);
        exit;
    }
    
    if (empty($name) || empty($email) || empty($type) || empty($message)) {
        echo json_encode(['success' => false, 'message' => 'All fields are required.']);
        exit;
    }
    
    // Get user_id if user is logged in
    $user_id = is_logged_in() ? $_SESSION['user_id'] : null;
    
    // Insert feedback into database
    $stmt = $conn->prepare("INSERT INTO feedback (user_id, rating, feedback_type, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $user_id, $rating, $type, $message);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error submitting feedback. Please try again.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
} 