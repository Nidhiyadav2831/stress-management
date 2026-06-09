<?php
// Database configuration
$db_host = 'localhost';
$db_user = 'root';
$db_pass = '';

// Create connection without database
$conn = new mysqli($db_host, $db_user, $db_pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Read SQL file
$sql = file_get_contents('setup.sql');

// Execute multi query
if ($conn->multi_query($sql)) {
    echo "Database and tables created successfully";
} else {
    echo "Error creating database and tables: " . $conn->error;
}

$conn->close();
?> 