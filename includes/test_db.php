<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<h2>Database Connection Test</h2>";

// Test database connection without database
$conn = new mysqli('localhost', 'root', '');

if ($conn->connect_error) {
    die("Initial connection failed: " . $conn->connect_error);
}
echo "Initial connection successful!<br>";

// Test if database exists
$result = $conn->query("SHOW DATABASES LIKE 'serenmind'");
if ($result->num_rows > 0) {
    echo "Database 'serenmind' exists!<br>";
    
    // Select the database
    if (!$conn->select_db('serenmind')) {
        die("Failed to select database: " . $conn->error);
    }
    echo "Successfully selected database 'serenmind'<br>";
    
    // Test if users table exists
    $result = $conn->query("SHOW TABLES LIKE 'users'");
    if ($result->num_rows > 0) {
        echo "Users table exists!<br>";
        
        // Check table structure
        $result = $conn->query("DESCRIBE users");
        echo "<h3>Users Table Structure:</h3>";
        echo "<pre>";
        while ($row = $result->fetch_assoc()) {
            print_r($row);
        }
        echo "</pre>";
        
        // Check if there are any users
        $result = $conn->query("SELECT COUNT(*) as count FROM users");
        $row = $result->fetch_assoc();
        echo "Number of users in database: " . $row['count'] . "<br>";
        
        // Show sample user data (without passwords)
        $result = $conn->query("SELECT user_id, name, email FROM users LIMIT 5");
        echo "<h3>Sample Users:</h3>";
        echo "<pre>";
        while ($row = $result->fetch_assoc()) {
            print_r($row);
        }
        echo "</pre>";
    } else {
        echo "Users table does not exist!<br>";
        
        // Try to create the users table
        $sql = "CREATE TABLE IF NOT EXISTS users (
            user_id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        if ($conn->query($sql) === TRUE) {
            echo "Successfully created users table!<br>";
        } else {
            echo "Error creating users table: " . $conn->error . "<br>";
        }
    }
} else {
    echo "Database 'serenmind' does not exist!<br>";
    
    // Try to create the database
    if ($conn->query("CREATE DATABASE serenmind")) {
        echo "Successfully created database 'serenmind'!<br>";
    } else {
        echo "Error creating database: " . $conn->error . "<br>";
    }
}

// Test if we can insert a test user
$test_email = "test@example.com";
$test_password = password_hash("test123", PASSWORD_DEFAULT);
$test_name = "Test User";

try {
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    if (!$stmt) {
        throw new Exception("Prepare statement failed: " . $conn->error);
    }
    
    $stmt->bind_param("sss", $test_name, $test_email, $test_password);
    if ($stmt->execute()) {
        echo "Successfully created test user!<br>";
    } else {
        echo "Failed to create test user: " . $stmt->error . "<br>";
    }
} catch (Exception $e) {
    echo "Error creating test user: " . $e->getMessage() . "<br>";
}

// Close connection
$conn->close();
?> 