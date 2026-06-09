<?php
require_once 'includes/db_connect.php';

// Handle feedback submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_feedback'])) {
    $rating = isset($_POST['rating']) ? (int)sanitize_input($_POST['rating']) : null;
    $name = isset($_POST['name']) ? sanitize_input($_POST['name']) : null;
    $email = isset($_POST['email']) ? sanitize_input($_POST['email']) : null;
    $type = isset($_POST['type']) ? sanitize_input($_POST['type']) : null;
    $message = isset($_POST['message']) ? sanitize_input($_POST['message']) : null;
    
    // Validate required fields
    if ($rating === null || $rating < 1 || $rating > 5) {
        $error_message = "Please select a valid rating (1-5).";
    } elseif (empty($name) || empty($email) || empty($type) || empty($message)) {
        $error_message = "All fields are required.";
    } else {
        // Get user_id if user is logged in
        $user_id = is_logged_in() ? $_SESSION['user_id'] : null;
        
        // Insert feedback into database
        $stmt = $conn->prepare("INSERT INTO feedback (user_id, rating, feedback_type, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiss", $user_id, $rating, $type, $message);
        
        if ($stmt->execute()) {
            $success_message = "Thank you for your feedback!";
            // Clear form data after successful submission
            $_POST = array();
            // Don't redirect, just show success message
        } else {
            $error_message = "Error submitting feedback. Please try again.";
        }
    }
}
?>

<!-- Feedback Section -->
<section id="feedback" class="section">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold gradient-text text-center mb-8">Share Your Experience</h1>
        
        <div id="feedbackMessage" class="mb-4"></div>
        
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8">
            <form id="feedbackForm" class="space-y-6">
                <!-- Rating Section -->
                <div class="mb-8">
                    <label class="block text-gray-700 dark:text-gray-300 mb-4 text-lg">How would you rate your experience?</label>
                    <div class="flex justify-center space-x-4">
                        <button type="button" onclick="setRating(1)" class="rating-btn text-4xl hover:scale-110 transition-transform">😞</button>
                        <button type="button" onclick="setRating(2)" class="rating-btn text-4xl hover:scale-110 transition-transform">😐</button>
                        <button type="button" onclick="setRating(3)" class="rating-btn text-4xl hover:scale-110 transition-transform">😊</button>
                        <button type="button" onclick="setRating(4)" class="rating-btn text-4xl hover:scale-110 transition-transform">😄</button>
                        <button type="button" onclick="setRating(5)" class="rating-btn text-4xl hover:scale-110 transition-transform">🤩</button>
                    </div>
                    <input type="hidden" name="rating" id="rating" value="0" required>
                </div>

                <!-- Name -->
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 mb-2">Name</label>
                    <input type="text" name="name" id="feedbackName" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 mb-2">Email</label>
                    <input type="email" name="email" id="feedbackEmail" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                </div>

                <!-- Feedback Type -->
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 mb-2">Feedback Type</label>
                    <select name="type" id="feedbackType" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required>
                        <option value="">Select feedback type</option>
                        <option value="suggestion">Suggestion</option>
                        <option value="complaint">Complaint</option>
                        <option value="praise">Praise</option>
                        <option value="question">Question</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <!-- Message -->
                <div>
                    <label class="block text-gray-700 dark:text-gray-300 mb-2">Your Feedback</label>
                    <textarea name="message" id="feedbackMessage" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-emerald-500 text-white py-3 rounded-lg hover:opacity-90 transition-opacity">
                    Submit Feedback
                </button>
            </form>
        </div>
    </div>
</section>

<style>
.rating-btn {
    opacity: 0.5;
    transition: all 0.3s ease;
}

.rating-btn.active {
    opacity: 1;
    transform: scale(1.2);
}
</style>

<script>
function setRating(rating) {
    // Remove active class from all buttons
    document.querySelectorAll('.rating-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    
    // Add active class to selected button
    document.querySelectorAll('.rating-btn')[rating - 1].classList.add('active');
    
    // Update hidden input
    document.getElementById('rating').value = rating;
}

// Handle form submission
document.getElementById('feedbackForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    formData.append('submit_feedback', '1');
    
    // Show loading state
    const submitButton = this.querySelector('button[type="submit"]');
    const originalButtonText = submitButton.innerHTML;
    submitButton.innerHTML = 'Submitting...';
    submitButton.disabled = true;
    
    fetch('includes/submit_feedback.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Show success message
            const messageDiv = document.getElementById('feedbackMessage');
            messageDiv.className = 'bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4';
            messageDiv.innerHTML = '<span class="block sm:inline">Thank you for your feedback!</span>';
            
            // Reset form
            this.reset();
            document.querySelectorAll('.rating-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            document.getElementById('rating').value = '0';
            
            // Hide message after 3 seconds
            setTimeout(() => {
                messageDiv.className = 'hidden';
            }, 3000);
        } else {
            // Show error message
            const messageDiv = document.getElementById('feedbackMessage');
            messageDiv.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4';
            messageDiv.innerHTML = `<span class="block sm:inline">${data.message || 'Error submitting feedback. Please try again.'}</span>`;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Show error message
        const messageDiv = document.getElementById('feedbackMessage');
        messageDiv.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4';
        messageDiv.innerHTML = '<span class="block sm:inline">An error occurred. Please try again.</span>';
    })
    .finally(() => {
        // Reset button state
        submitButton.innerHTML = originalButtonText;
        submitButton.disabled = false;
    });
});
</script> 