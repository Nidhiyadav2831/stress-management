<!-- Login/Signup Section -->
<section id="login" class="section">
    <div class="max-w-md mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8 mt-10">
        <div class="flex justify-center space-x-4 mb-6">
            <button id="loginTab" class="text-xl font-bold gradient-text active" onclick="switchAuthTab('login')">Login</button>
            <button id="signupTab" class="text-xl font-bold text-gray-500" onclick="switchAuthTab('signup')">Sign Up</button>
        </div>
       
        <!-- Mood Selection Section -->
        <div id="moodSection" class="mb-8">
            <h2 class="text-2xl font-bold text-center gradient-text mb-6">How are you feeling today?</h2>
            <div class="grid grid-cols-2 gap-4">
                <button onclick="selectMood('happy')" class="mood-button p-4 rounded-xl bg-gradient-to-r from-yellow-100 to-yellow-200 dark:from-yellow-900 dark:to-yellow-800 hover:scale-105 transition-transform">
                    <div class="text-4xl mb-2">😊</div>
                    <span class="font-semibold">Happy</span>
                </button>
                <button onclick="selectMood('stressed')" class="mood-button p-4 rounded-xl bg-gradient-to-r from-red-100 to-red-200 dark:from-red-900 dark:to-red-800 hover:scale-105 transition-transform">
                    <div class="text-4xl mb-2">😫</div>
                    <span class="font-semibold">Stressed</span>
                </button>
                <button onclick="selectMood('fine')" class="mood-button p-4 rounded-xl bg-gradient-to-r from-green-100 to-green-200 dark:from-green-900 dark:to-green-800 hover:scale-105 transition-transform">
                    <div class="text-4xl mb-2">😌</div>
                    <span class="font-semibold">Fine</span>
                </button>
                <button onclick="selectMood('share')" class="mood-button p-4 rounded-xl bg-gradient-to-r from-blue-100 to-blue-200 dark:from-blue-900 dark:to-blue-800 hover:scale-105 transition-transform">
                    <div class="text-4xl mb-2">💭</div>
                    <span class="font-semibold">Share</span>
                </button>
            </div>
            <div id="moodMessage" class="mt-6 text-center text-lg font-medium hidden">
                <!-- Mood messages will be displayed here -->
            </div>
        </div>
       
        <!-- Login Form -->
        <div id="loginForm" class="auth-form">
            <h2 class="text-3xl font-bold text-center gradient-text mb-8">Welcome Back</h2>
            <form onsubmit="login(event)" autocomplete="off">
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 mb-2">Email</label>
                    <input type="email" id="loginEmail" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required autocomplete="off">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 mb-2">Password</label>
                    <input type="password" id="loginPassword" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required autocomplete="new-password">
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-emerald-500 text-white py-2 rounded-lg hover:opacity-90 transition-opacity">
                    Login
                </button>
            </form>
        </div>

        <!-- Signup Form -->
        <div id="signupForm" class="auth-form hidden">
            <h2 class="text-3xl font-bold text-center gradient-text mb-8">Create Account</h2>
            <form onsubmit="signup(event)" autocomplete="off">
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 mb-2">Name</label>
                    <input type="text" id="signupName" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required autocomplete="off">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 mb-2">Email</label>
                    <input type="email" id="signupEmail" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required autocomplete="off">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 dark:text-gray-300 mb-2">Password</label>
                    <input type="password" id="signupPassword" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required
                           pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$"
                           title="Password must contain at least one letter, one number, and one special character"
                           autocomplete="new-password">
                    <p class="text-sm text-gray-500 mt-1">Password must contain letters, numbers, and special characters</p>
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 dark:text-gray-300 mb-2">Confirm Password</label>
                    <input type="password" id="confirmPassword" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500" required autocomplete="new-password">
                </div>
                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-emerald-500 text-white py-2 rounded-lg hover:opacity-90 transition-opacity">
                    Sign Up
                </button>
            </form>
        </div>
    </div>
</section> 