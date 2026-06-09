<?php
session_start();
header('Content-Type: application/json');

// Function to send JSON response
function sendJsonResponse($success, $message = '', $data = null) {
    $response = [
        'success' => $success,
        'message' => $message
    ];
    if ($data !== null) {
        $response['data'] = $data;
    }
    echo json_encode($response);
    exit;
}

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    sendJsonResponse(true, 'User is logged in', [
        'user' => [
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'],
            'email' => $_SESSION['user_email']
        ]
    ]);
} else {
    sendJsonResponse(false, 'User is not logged in');
}
?> 