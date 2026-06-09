<?php
require_once 'includes/db_connect.php';

// Get photos from database
$photos = [];
$stmt = $conn->prepare("SELECT p.*, u.name as user_name FROM photos p LEFT JOIN users u ON p.user_id = u.user_id ORDER BY p.created_at DESC");
$stmt->execute();
$result = $stmt->get_result();
while ($row = $result->fetch_assoc()) {
    $photos[] = $row;
}
?>

<!-- Photo Post Section -->
<section id="photos" class="section">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-4xl font-bold gradient-text text-center mb-8">Share Your Emotions</h1>
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-6">
            <!-- Notification Area -->
            <div id="notification" class="fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform transition-all duration-300 opacity-0" style="display: none;"></div>

            <!-- Emotion Input Section -->
            <div class="mb-6">
                <textarea id="emotionInput" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500"
                    placeholder="How are you feeling today? Share your emotions..."></textarea>
                <div class="mt-2 flex justify-between items-center">
                    <input type="file" id="photoInput" accept="image/*" class="hidden">
                    <label for="photoInput" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-emerald-500 text-white rounded-lg cursor-pointer hover:opacity-90">
                        Add Photo
                    </label>
                    <button onclick="postEmotion()" class="px-4 py-2 bg-gradient-to-r from-indigo-600 to-emerald-500 text-white rounded-lg hover:opacity-90">
                        Share
                    </button>
                </div>
            </div>
           
            <!-- Posts Grid -->
            <div class="space-y-6 mb-8" id="postsGrid">
                <?php foreach ($photos as $photo): ?>
                <div class="post-card bg-white dark:bg-gray-800 rounded-xl shadow-xl p-4">
                    <div class="mb-4">
                        <p class="text-gray-700 dark:text-gray-300"><?php echo htmlspecialchars($photo['emotion_text']); ?></p>
                        <?php if ($photo['photo_path']): ?>
                        <img src="uploads/photos/<?php echo htmlspecialchars($photo['photo_path']); ?>" 
                             alt="Post image" 
                             class="post-image rounded-lg mt-2 w-full h-64 object-cover">
                        <?php endif; ?>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">Posted by <?php echo htmlspecialchars($photo['user_name']); ?></span>
                        <span class="text-sm text-gray-500"><?php echo date('F j, Y g:i a', strtotime($photo['created_at'])); ?></span>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
           
            <!-- Next Button -->
            <div class="text-center">
                <button onclick="showSection('contact')" class="px-8 py-3 bg-gradient-to-r from-purple-600 to-pink-500 text-white rounded-lg hover:opacity-90 transition-opacity transform hover:scale-105 transition-transform duration-300">
                    Next: Contact <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<script>
function showNotification(message, type = 'success') {
    const notification = document.getElementById('notification');
    notification.textContent = message;
    notification.className = `fixed top-4 right-4 px-6 py-3 rounded-lg shadow-lg transform transition-all duration-300 ${
        type === 'success' ? 'bg-green-500' : 'bg-red-500'
    } text-white`;
    notification.style.display = 'block';
    notification.style.opacity = '1';
    
    setTimeout(() => {
        notification.style.opacity = '0';
        setTimeout(() => {
            notification.style.display = 'none';
        }, 300);
    }, 3000);
}

function postEmotion() {
    const emotionText = document.getElementById('emotionInput').value;
    const photoInput = document.getElementById('photoInput');
    const file = photoInput.files[0];

    if (!emotionText && !file) {
        showNotification('Please share your emotion or add a photo', 'error');
        return;
    }

    const formData = new FormData();
    formData.append('emotion_text', emotionText);
    if (file) {
        formData.append('photo', file);
    }

    fetch('includes/upload_photo.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Photo posted successfully! 🎉');
            // Clear the form
            document.getElementById('emotionInput').value = '';
            document.getElementById('photoInput').value = '';
            // Add the new post to the grid without reloading
            const postsGrid = document.getElementById('postsGrid');
            const newPost = document.createElement('div');
            newPost.className = 'post-card bg-white dark:bg-gray-800 rounded-xl shadow-xl p-4';
            newPost.innerHTML = `
                <div class="mb-4">
                    <p class="text-gray-700 dark:text-gray-300">${emotionText}</p>
                    ${file ? `<img src="${URL.createObjectURL(file)}" alt="Post image" class="post-image rounded-lg mt-2 w-full h-64 object-cover">` : ''}
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500">Posted by You</span>
                    <span class="text-sm text-gray-500">Just now</span>
                </div>
            `;
            postsGrid.insertBefore(newPost, postsGrid.firstChild);
        } else {
            showNotification(data.message || 'Error posting photo', 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('An error occurred while posting', 'error');
    });
}
</script> 