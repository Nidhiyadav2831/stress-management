<!-- Breathing Section -->
<section id="breathing" class="section">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold gradient-text text-center mb-8">Box Breathing Exercise</h1>
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-8">
            <div class="text-center mb-8">
                <p class="text-lg text-gray-600 dark:text-gray-300 mb-4">
                    Box breathing is a simple but powerful technique for reducing stress and improving focus.
                    Follow the circle animation and breathe in a 4-4-4-4 pattern.
                </p>
                <div class="breathing-circle" id="boxBreathingCircle">
                    Ready
                </div>
                <p class="mt-4 text-center text-gray-600 dark:text-gray-300">
                    Inhale (4s) → Hold (4s) → Exhale (4s) → Hold (4s)
                </p>
            </div>
            <div class="flex justify-center space-x-4">
                <button onclick="startBoxBreathing()" class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-emerald-500 text-white rounded-lg hover:opacity-90 transition-opacity" id="startBoxBreathing">
                    Start Exercise
                </button>
                <button onclick="stopBoxBreathing()" class="px-8 py-3 bg-red-500 text-white rounded-lg hover:opacity-90 transition-opacity hidden" id="stopBoxBreathing">
                    Stop Exercise
                </button>
            </div>
            <!-- Next Button -->
            <div class="mt-8 text-center">
                <button onclick="showSection('meditation')" class="px-8 py-3 bg-gradient-to-r from-purple-600 to-pink-500 text-white rounded-lg hover:opacity-90 transition-opacity transform hover:scale-105 transition-transform duration-300">
                    Next: Meditation <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </div>
</section> 