<?php
session_start();
require_once 'db_connect.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if user is logged in
    if (!is_logged_in()) {
        echo json_encode(['success' => false, 'message' => 'Please login to share photos']);
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $emotion_text = isset($_POST['emotion_text']) ? sanitize_input($_POST['emotion_text']) : '';
    
    // Handle file upload
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../uploads/photos/';
        
        // Create directory if it doesn't exist
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $file_extension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));
        $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
        
        if (!in_array($file_extension, $allowed_extensions)) {
            echo json_encode(['success' => false, 'message' => 'Invalid file type. Only JPG, JPEG, PNG and GIF are allowed.']);
            exit;
        }
        
        $file_name = uniqid() . '.' . $file_extension;
        $target_path = $upload_dir . $file_name;
        
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_path)) {
            // Insert photo record into database
            $stmt = $conn->prepare("INSERT INTO photos (user_id, emotion_text, photo_path) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $user_id, $emotion_text, $file_name);
            
            if ($stmt->execute()) {
                echo json_encode([
                    'success' => true,
                    'message' => 'Photo uploaded successfully',
                    'photo_id' => $stmt->insert_id,
                    'photo_path' => $file_name
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Error saving photo to database']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Error uploading photo']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No photo uploaded']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?> 