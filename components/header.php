<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SereneMind - Your Mental Wellness Companion</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- AOS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <?php
    require_once 'includes/db_connect.php';
    session_start();
    ?>
    <!-- Navigation -->
    <nav class="bg-white dark:bg-gray-800 shadow-lg fixed w-full z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="/" class="flex-shrink-0 flex items-center">
                        <span class="text-2xl font-bold gradient-text">SereneMind</span>
                    </a>
                </div>
                
                <?php if (!is_logged_in()): ?>
                <!-- Auth Buttons (shown when not logged in) -->
                <div class="auth-buttons flex items-center space-x-4">
                    <button onclick="scrollToSection('login')" class="text-gray-700 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                        Login
                    </button>
                    <button onclick="scrollToSection('login')" class="bg-gradient-to-r from-indigo-600 to-emerald-500 text-white px-4 py-2 rounded-lg hover:opacity-90 transition-opacity">
                        Sign Up
                    </button>
                </div>
                <?php else: ?>
                <!-- User Menu (shown when logged in) -->
                <div class="user-menu flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-user-circle text-gray-700 dark:text-gray-300"></i>
                        <span class="user-name text-gray-700 dark:text-gray-300 font-medium"><?php echo $_SESSION['user_name']; ?></span>
                    </div>
                    <button onclick="logout()" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition-colors">
                        Logout
                    </button>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Notification -->
    <div id="notification" class="fixed top-20 right-4 bg-gray-800 text-white px-6 py-3 rounded-lg shadow-lg transform transition-transform duration-300 ease-in-out" style="display: none; z-index: 1000;"></div>

    <!-- Add some padding to the top of the body to account for fixed navigation -->
    <div class="pt-16">
        <!-- Your page content goes here -->
    </div>
</body>
</html> 