<?php
require_once 'db_connect.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_contact'])) {
    // Check if all required fields are present
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
        $name = sanitize_input($_POST['name']);
        $email = sanitize_input($_POST['email']);
        $subject = sanitize_input($_POST['subject']);
        $message = sanitize_input($_POST['message']);
        
        // Get user_id if user is logged in
        $user_id = is_logged_in() ? $_SESSION['user_id'] : null;
        
        // Insert contact message into database
        $stmt = $conn->prepare("INSERT INTO contact_messages (user_id, name, email, subject, message) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $user_id, $name, $email, $subject, $message);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error sending message. Please try again.']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
} 