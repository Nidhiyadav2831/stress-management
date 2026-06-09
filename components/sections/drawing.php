<!-- Drawing Section -->
<section id="drawing" class="section">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-4xl font-bold gradient-text text-center mb-8">Express Yourself</h1>
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-6">
            <div class="flex flex-wrap justify-between mb-4">
                <!-- Brush Tools -->
                <div class="flex space-x-2 mb-4">
                    <button onclick="selectTool('pencil')" class="tool-button active" id="pencilTool">
                        <i class="fas fa-pencil-alt"></i> Pencil
                    </button>
                    <button onclick="selectTool('brush')" class="tool-button" id="brushTool">
                        <i class="fas fa-paint-brush"></i> Brush
                    </button>
                    <button onclick="selectTool('marker')" class="tool-button" id="markerTool">
                        <i class="fas fa-highlighter"></i> Marker
                    </button>
                    <button onclick="selectTool('eraser')" class="tool-button" id="eraserTool">
                        <i class="fas fa-eraser"></i> Eraser
                    </button>
                </div>

                <!-- Color Picker and Preset Colors -->
                <div class="flex items-center space-x-4 mb-4">
                    <div class="flex items-center">
                        <label class="mr-2 text-gray-700 dark:text-gray-300">Color:</label>
                        <input type="color" id="colorPicker" class="w-8 h-8 rounded cursor-pointer" value="#000000">
                    </div>
                    <div class="flex space-x-2">
                        <button onclick="changeColor('black')" class="w-8 h-8 bg-black rounded-full hover:scale-110 transition-transform"></button>
                        <button onclick="changeColor('red')" class="w-8 h-8 bg-red-500 rounded-full hover:scale-110 transition-transform"></button>
                        <button onclick="changeColor('blue')" class="w-8 h-8 bg-blue-500 rounded-full hover:scale-110 transition-transform"></button>
                        <button onclick="changeColor('green')" class="w-8 h-8 bg-green-500 rounded-full hover:scale-110 transition-transform"></button>
                        <button onclick="changeColor('yellow')" class="w-8 h-8 bg-yellow-500 rounded-full hover:scale-110 transition-transform"></button>
                        <button onclick="changeColor('purple')" class="w-8 h-8 bg-purple-500 rounded-full hover:scale-110 transition-transform"></button>
                    </div>
                </div>

                <!-- Brush Size -->
                <div class="flex items-center space-x-2 mb-4">
                    <label class="text-gray-700 dark:text-gray-300">Size:</label>
                    <input type="range" min="1" max="50" value="5" class="w-32" id="sizeSlider" onchange="updateSize(this.value)">
                    <span id="sizeValue" class="text-gray-700 dark:text-gray-300">5px</span>
                </div>

                <button onclick="clearCanvas()" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:opacity-90 transition-opacity">
                    Clear Canvas
                </button>
            </div>
            <canvas id="drawingCanvas" width="800" height="500"></canvas>
           
            <!-- Next Button -->
            <div class="fixed bottom-4 right-4">
                <button onclick="showSection('photos')" class="px-8 py-3 bg-gradient-to-r from-purple-600 to-pink-500 text-white rounded-lg hover:opacity-90 transition-opacity transform hover:scale-105 transition-transform duration-300 shadow-lg">
                    Next: Photos <i class="fas fa-arrow-right ml-2"></i>
                </button>
            </div>
        </div>
    </div>
</section> 

<script>
    // Canvas setup
    const canvas = document.getElementById('drawingCanvas');
    const ctx = canvas.getContext('2d');
    const colorPicker = document.getElementById('colorPicker');
    const sizeSlider = document.getElementById('sizeSlider');
    const sizeValue = document.getElementById('sizeValue');
    
    // Drawing state
    let isDrawing = false;
    let currentTool = 'pencil';
    let currentColor = '#000000';
    let currentSize = 5;
    let lastX = 0;
    let lastY = 0;
    
    // Initialize canvas
    function initCanvas() {
        // Set canvas background to white
        ctx.fillStyle = 'white';
        ctx.fillRect(0, 0, canvas.width, canvas.height);
        
        // Set default styles
        ctx.strokeStyle = currentColor;
        ctx.lineWidth = currentSize;
        ctx.lineCap = 'round';
        ctx.lineJoin = 'round';
    }
    
    // Tool selection
    function selectTool(tool) {
        currentTool = tool;
        
        // Update active button
        document.querySelectorAll('.tool-button').forEach(btn => {
            btn.classList.remove('active');
        });
        document.getElementById(`${tool}Tool`).classList.add('active');
        
        // Change cursor based on tool
        switch(tool) {
            case 'eraser':
                canvas.style.cursor = 'url("data:image/svg+xml;utf8,<svg xmlns=\'http://www.w3.org/2000/svg\' width=\'16\' height=\'16\' viewBox=\'0 0 16 16\'><rect width=\'16\' height=\'16\' fill=\'white\'/><rect x=\'2\' y=\'2\' width=\'12\' height=\'12\' fill=\'black\'/></svg>") 8 8, auto';
                break;
            default:
                canvas.style.cursor = 'crosshair';
        }
    }
    
    // Color change
    function changeColor(color) {
        const colors = {
            'black': '#000000',
            'red': '#ff0000',
            'blue': '#0000ff',
            'green': '#00ff00',
            'yellow': '#ffff00',
            'purple': '#800080'
        };
        
        currentColor = colors[color] || color;
        colorPicker.value = currentColor;
        ctx.strokeStyle = currentColor;
    }
    
    // Size update
    function updateSize(size) {
        currentSize = size;
        sizeValue.textContent = `${size}px`;
        ctx.lineWidth = size;
    }
    
    // Clear canvas
    function clearCanvas() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        initCanvas();
    }
    
    // Drawing functions
    function startDrawing(e) {
        isDrawing = true;
        [lastX, lastY] = [e.offsetX, e.offsetY];
        
        // For tools that need to start drawing immediately
        if (currentTool === 'pencil' || currentTool === 'brush' || currentTool === 'marker') {
            draw(e);
        }
    }
    
    function draw(e) {
        if (!isDrawing) return;
        
        const x = e.offsetX;
        const y = e.offsetY;
        
        switch(currentTool) {
            case 'pencil':
                ctx.globalCompositeOperation = 'source-over';
                ctx.strokeStyle = currentColor;
                ctx.lineWidth = currentSize;
                break;
            case 'brush':
                ctx.globalCompositeOperation = 'source-over';
                ctx.strokeStyle = currentColor;
                ctx.lineWidth = currentSize * 2;
                break;
            case 'marker':
                ctx.globalCompositeOperation = 'multiply';
                ctx.strokeStyle = currentColor + '80'; // Add transparency
                ctx.lineWidth = currentSize * 3;
                break;
            case 'eraser':
                ctx.globalCompositeOperation = 'destination-out';
                ctx.lineWidth = currentSize * 2;
                break;
        }
        
        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(x, y);
        ctx.stroke();
        
        [lastX, lastY] = [x, y];
    }
    
    function stopDrawing() {
        isDrawing = false;
    }
    
    // Color picker event
    colorPicker.addEventListener('input', function() {
        currentColor = this.value;
        ctx.strokeStyle = currentColor;
    });
    
    // Event listeners
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseout', stopDrawing);
    
    // Touch support
    canvas.addEventListener('touchstart', function(e) {
        e.preventDefault();
        const touch = e.touches[0];
        const rect = canvas.getBoundingClientRect();
        const mouseEvent = new MouseEvent('mousedown', {
            clientX: touch.clientX,
            clientY: touch.clientY,
            offsetX: touch.clientX - rect.left,
            offsetY: touch.clientY - rect.top
        });
        canvas.dispatchEvent(mouseEvent);
    });
    
    canvas.addEventListener('touchmove', function(e) {
        e.preventDefault();
        const touch = e.touches[0];
        const rect = canvas.getBoundingClientRect();
        const mouseEvent = new MouseEvent('mousemove', {
            clientX: touch.clientX,
            clientY: touch.clientY,
            offsetX: touch.clientX - rect.left,
            offsetY: touch.clientY - rect.top
        });
        canvas.dispatchEvent(mouseEvent);
    });
    
    canvas.addEventListener('touchend', function(e) {
        e.preventDefault();
        const mouseEvent = new MouseEvent('mouseup', {});
        canvas.dispatchEvent(mouseEvent);
    });
    
    // Initialize
    initCanvas();
    selectTool('pencil');
</script>