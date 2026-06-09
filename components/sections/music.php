<!-- Music Section -->
<section id="music" class="section">
    <div class="max-w-7xl mx-auto px-6 py-12">
        <!-- Hero Section -->
        <div class="flex justify-center items-center mb-16" data-aos="zoom-in">
            <div class="text-center px-6 py-8 bg-gradient-to-r from-purple-100 to-pink-100 dark:from-purple-900 dark:to-pink-900 rounded-3xl shadow-lg transform hover:scale-105 transition-transform duration-300">
                <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 mb-4 drop-shadow-md hover:text-white transition-all duration-500">
                    🎵 Explore Music 🎵
                </h1>
                <p class="text-lg md:text-xl text-gray-800 dark:text-gray-200 font-medium px-6 md:px-12 mb-8 opacity-80 hover:opacity-100 transition-opacity duration-300">
                    Feel the rhythm, calm your mind, and journey through sound.
                </p>
            </div>
        </div>

        <!-- Quick Access Menu -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16" data-aos="fade-up">
            <button class="bg-serene-100 dark:bg-serene-600 p-6 rounded-xl hover:bg-serene-200 dark:hover:bg-serene-500 transition transform hover:scale-105 shadow-md" onclick="scrollToSection('relaxation')">
                <i class="fas fa-spa text-serene-600 dark:text-serene-200 text-3xl mb-4"></i>
                <h3 class="text-xl font-semibold">Relaxation</h3>
                <p class="text-gray-600 dark:text-gray-300">Calm your mind and body</p>
            </button>
            <button class="bg-peaceful-100 dark:bg-peaceful-600 p-6 rounded-xl hover:bg-peaceful-200 dark:hover:bg-peaceful-500 transition transform hover:scale-105 shadow-md" onclick="scrollToSection('focus')">
                <i class="fas fa-brain text-peaceful-600 dark:text-peaceful-200 text-3xl mb-4"></i>
                <h3 class="text-xl font-semibold">Focus</h3>
                <p class="text-gray-600 dark:text-gray-300">Enhance concentration</p>
            </button>
            <button class="bg-tranquil-100 dark:bg-tranquil-600 p-6 rounded-xl hover:bg-tranquil-200 dark:hover:bg-tranquil-500 transition transform hover:scale-105 shadow-md" onclick="scrollToSection('sleep')">
                <i class="fas fa-moon text-tranquil-600 dark:text-tranquil-200 text-3xl mb-4"></i>
                <h3 class="text-xl font-semibold">Sleep</h3>
                <p class="text-gray-600 dark:text-gray-300">Drift into peaceful sleep</p>
            </button>
        </div>

        <!-- Relaxation Section -->
        <div id="relaxation" class="mb-16" data-aos="fade-up">
            <h2 class="text-2xl font-bold text-center mb-6 text-serene-600 dark:text-serene-200">Relaxation Music</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">Peaceful Morning</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-3">Gentle piano melodies</p>
                    <audio controls class="w-full rounded">
                        <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg" />
                    </audio>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">Ocean Breeze</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-3">Wave and wind harmony</p>
                    <audio controls class="w-full rounded">
                        <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-2.mp3" type="audio/mpeg" />
                    </audio>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">Forest Calm</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-3">Birdsong and stream</p>
                    <audio controls class="w-full rounded">
                        <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-3.mp3" type="audio/mpeg" />
                    </audio>
                </div>
            </div>
        </div>

        <!-- Focus Section -->
        <div id="focus" class="mb-16" data-aos="fade-up">
            <h2 class="text-2xl font-bold text-center mb-6 text-peaceful-600 dark:text-peaceful-200">Focus Music</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">Deep Work</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-3">Cognitive enhancer tones</p>
                    <audio controls class="w-full rounded">
                        <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-4.mp3" type="audio/mpeg" />
                    </audio>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">Zen Mind</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-3">Focus through simplicity</p>
                    <audio controls class="w-full rounded">
                        <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-5.mp3" type="audio/mpeg" />
                    </audio>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">Flow State</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-3">Instrumental flow builder</p>
                    <audio controls class="w-full rounded">
                        <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-6.mp3" type="audio/mpeg" />
                    </audio>
                </div>
            </div>
        </div>

        <!-- Sleep Section -->
        <div id="sleep" class="mb-16" data-aos="fade-up">
            <h2 class="text-2xl font-bold text-center mb-6 text-tranquil-600 dark:text-tranquil-200">Sleep Music</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">Night Rain</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-3">Soothing night rain</p>
                    <audio controls class="w-full rounded">
                        <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-7.mp3" type="audio/mpeg" />
                    </audio>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">Dreamscape</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-3">Ambient dream tones</p>
                    <audio controls class="w-full rounded">
                        <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-8.mp3" type="audio/mpeg" />
                    </audio>
                </div>
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md transform hover:scale-105 transition-transform duration-300">
                    <h3 class="text-lg font-semibold mb-2 text-gray-800 dark:text-gray-200">Moonlight Drift</h3>
                    <p class="text-gray-600 dark:text-gray-300 mb-3">Soft lullaby vibes</p>
                    <audio controls class="w-full rounded">
                        <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-9.mp3" type="audio/mpeg" />
                    </audio>
                </div>
            </div>
        </div>
       
        <!-- Next Button -->
        <div class="fixed bottom-4 right-4">
            <button onclick="showSection('drawing')" class="px-8 py-3 bg-gradient-to-r from-purple-600 to-pink-500 text-white rounded-lg hover:opacity-90 transition-opacity transform hover:scale-105 transition-transform duration-300 shadow-lg">
                Next: Drawing <i class="fas fa-arrow-right ml-2"></i>
            </button>
        </div>
    </div>
</section> 