<?php
require_once 'includes/db_connect.php';
?>
<!-- Navigation Bar -->
<nav class="fixed top-0 left-0 right-0 bg-white dark:bg-gray-800 shadow-lg z-50">
    <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <div class="text-2xl font-bold gradient-text cursor-pointer" onclick="showSection('landing')">SereneMind</div>
        </div>
        
        <div class="flex space-x-6">
            <!-- Features Dropdown -->
            <div class="relative group">
                <button class="nav-button flex items-center text-gray-800 dark:text-white">
                    Features 
                    <span class="ml-1 transform transition-transform duration-200 group-hover:rotate-180">▾</span>
                </button>
                <div class="hidden absolute left-0 pt-1 w-48 group-hover:block 
                            bg-white dark:bg-gray-700 shadow-lg rounded-md overflow-hidden z-50">
                    <button class="dropdown-item" onclick="showSection('breathing')">Breathing</button>
                    <button class="dropdown-item" onclick="showSection('meditation')">Meditation</button>
                    <button class="dropdown-item" onclick="showSection('music')">Music</button>
                    <button class="dropdown-item" onclick="showSection('drawing')">Drawing</button>
                    <button class="dropdown-item" onclick="showSection('photos')">Photos</button>
                </div>
            </div>
            
            <!-- About Link -->
            <button class="nav-button text-gray-800 dark:text-white" onclick="showSection('about')">About</button>
            
            <!-- Connect Dropdown -->
            <div class="relative group">
                <button class="nav-button flex items-center text-gray-800 dark:text-white">
                    Connect 
                    <span class="ml-1 transform transition-transform duration-200 group-hover:rotate-180">▾</span>
                </button>
                <div class="hidden absolute left-0 pt-1 w-48 group-hover:block 
                            bg-white dark:bg-gray-700 shadow-lg rounded-md overflow-hidden z-50">
                    <button class="dropdown-item" onclick="showSection('feedback')">Feedback</button>
                    <button class="dropdown-item" onclick="showSection('contact')">Contact</button>
                </div>
            </div>

            <?php if (is_logged_in()): ?>
                <!-- Logout Button -->
                <button class="nav-button text-gray-800 dark:text-white" onclick="logout()">Logout</button>
            <?php else: ?>
                <!-- Login Button -->
                <button class="nav-button text-gray-800 dark:text-white" onclick="showSection('login')">Login</button>
            <?php endif; ?>
        </div>
    </div>
</nav>

<style>
    .nav-button {
        transition: all 0.2s ease;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
    }
    .nav-button:hover {
        background-color: rgba(59, 130, 246, 0.1);
        color: #3b82f6;
    }
    .dark .nav-button:hover {
        background-color: rgba(96, 165, 250, 0.1);
        color: #60a5fa;
    }
    .gradient-text {
        background: linear-gradient(90deg, #3b82f6, #8b5cf6);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }
    .dropdown-item {
        display: block;
        width: 100%;
        text-align: left;
        padding: 0.5rem 1rem;
        color:rgb(238, 238, 240);
        background-color: transparent;
        transition: background-color 0.2s;
    }
    .dropdown-item:hover {
        background-color:rgb(9, 88, 246);
    }
    .dark .dropdown-item {
        color: #e5e7eb;
    }
    .dark .dropdown-item:hover {
        background-color: #4b5563;
    }
    /* Important new fix */
    .section {
        display: none;
    }
    .section.active {
        display: block;
    }
</style>

<script>
function showSection(sectionId) {
    // Hide all sections
    document.querySelectorAll('.section').forEach(section => {
        section.classList.remove('active');
    });

    // Show the selected section
    const selectedSection = document.getElementById(sectionId);
    if (selectedSection) {
        selectedSection.classList.add('active');
    }

    // Update active state of navigation buttons
    document.querySelectorAll('.nav-button').forEach(button => {
        button.classList.remove('active');
    });

    // Handle Home button visibility
    const homeButton = document.getElementById('homeButton');
    if (sectionId === 'login') {
        homeButton.style.display = 'none';
    } else {
        homeButton.style.display = 'block';
    }

    // Scroll to top of the page
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Show landing page by default when page loads
document.addEventListener('DOMContentLoaded', function() {
    showSection('landing');
});

function logout() {
    fetch('includes/logout.php')
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
</script>
