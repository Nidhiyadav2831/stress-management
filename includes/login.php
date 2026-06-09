<?php
// Prevent any output before headers
ob_start();

// Start session
session_start();
require_once 'db_connect.php';

// Disable error display to prevent HTML output
error_reporting(E_ALL);
ini_set('display_errors', 0);

// Set proper JSON header
header('Content-Type: application/json');

// Function to send JSON response
function sendJsonResponse($success, $message, $data = null) {
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

// Get POST data
$raw_data = file_get_contents('php://input');
$data = json_decode($raw_data, true);

// Check for JSON parsing errors
if (json_last_error() !== JSON_ERROR_NONE) {
    sendJsonResponse(false, 'Invalid request data', ['error' => json_last_error_msg()]);
}

// Validate that required fields exist
if (!isset($data['email']) || !isset($data['password'])) {
    sendJsonResponse(false, 'Missing required fields');
}

$email = sanitize_input($data['email']);
$password = $data['password'];

// Validate input
if (empty($email) || empty($password)) {
    sendJsonResponse(false, 'Please fill in all fields');
}

try {
    // Verify database connection
    if ($conn->connect_error) {
        throw new Exception("Database connection failed: " . $conn->connect_error);
    }

    // Check if user exists
    $stmt = $conn->prepare("SELECT user_id, name, email, password FROM users WHERE email = ?");
    if (!$stmt) {
        throw new Exception("Prepare statement failed: " . $conn->error);
    }

    $stmt->bind_param("s", $email);
    if (!$stmt->execute()) {
        throw new Exception("Execute failed: " . $stmt->error);
    }

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        sendJsonResponse(false, 'Invalid email or password');
    }

    // Verify password
    if (!password_verify($password, $user['password'])) {
        sendJsonResponse(false, 'Invalid email or password');
    }

    // Set session variables
    $_SESSION['user_id'] = $user['user_id'];
    $_SESSION['user_name'] = $user['name'];
    $_SESSION['user_email'] = $user['email'];
    
    // Verify session was set
    if (!isset($_SESSION['user_id'])) {
        throw new Exception("Failed to set session variables");
    }
    
    // Set session cookie parameters
    session_set_cookie_params([
        'lifetime' => 86400, // 24 hours
        'path' => '/',
        'domain' => '',
        'secure' => false,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    
    // Regenerate session ID for security
    session_regenerate_id(true);
    
    sendJsonResponse(true, 'Login successful', [
        'user' => [
            'id' => $user['user_id'],
            'name' => $user['name'],
            'email' => $user['email']
        ]
    ]);

} catch (Exception $e) {
    error_log("Login error: " . $e->getMessage());
    error_log("Stack trace: " . $e->getTraceAsString());
    sendJsonResponse(false, 'An error occurred during login', ['error' => $e->getMessage()]);
}
?> 