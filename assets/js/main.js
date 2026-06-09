// Initialize AOS
AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true
});

// Check login status when page loads
document.addEventListener('DOMContentLoaded', function() {
    checkNavigationElements();
    checkLoginStatus();
});

// Function to check login status
function checkLoginStatus() {
    console.log('Checking login status...');
    fetch('includes/check_session.php')
        .then(response => response.json())
        .then(data => {
            console.log('Session check response:', data);
            if (data.success && data.data && data.data.user) {
                console.log('User data found:', data.data.user);
                updateNavigation(true, data.data.user);
            } else {
                console.log('No user data found');
                updateNavigation(false);
            }
        })
        .catch(error => {
            console.error('Session check error:', error);
            updateNavigation(false);
        });
}

// Add scrollToSection function
function scrollToSection(id) {
    const section = document.getElementById(id);
    if (section) section.scrollIntoView({ behavior: 'smooth' });
}

// Show section function
// function showSection(sectionId) {
//     // Hide all sections
//     document.querySelectorAll('.section').forEach(section => {
//         section.classList.remove('active');
//     });
   
//     // Show the selected section
//     const targetSection = document.getElementById(sectionId);
//     if (targetSection) {
//         targetSection.classList.add('active');
        
//         // Update active state of navigation buttons
//         document.querySelectorAll('.nav-button').forEach(button => {
//             button.classList.remove('active');
//         });
//         const activeButton = document.querySelector(`button[onclick="showSection('${sectionId}')"]`);
//         if (activeButton) {
//             activeButton.classList.add('active');
//         }
//     }
// }

// Auth tab switching
function switchAuthTab(tab) {
    const loginForm = document.getElementById('loginForm');
    const signupForm = document.getElementById('signupForm');
    const loginTab = document.getElementById('loginTab');
    const signupTab = document.getElementById('signupTab');

    if (tab === 'login') {
        loginForm.classList.remove('hidden');
        signupForm.classList.add('hidden');
        loginTab.classList.add('gradient-text');
        loginTab.classList.remove('text-gray-500');
        signupTab.classList.remove('gradient-text');
        signupTab.classList.add('text-gray-500');
    } else {
        loginForm.classList.add('hidden');
        signupForm.classList.remove('hidden');
        signupTab.classList.add('gradient-text');
        signupTab.classList.remove('text-gray-500');
        loginTab.classList.remove('gradient-text');
        loginTab.classList.add('text-gray-500');
    }
}

// Login function
function login(event) {
    console.log('Login function called');
    event.preventDefault();
    const email = document.getElementById('loginEmail').value;
    const password = document.getElementById('loginPassword').value;
   
    console.log('Form values:', { email, password: '***' });
   
    if (email && password) {
        // Show loading state
        const submitButton = document.querySelector('#loginForm button[type="submit"]');
        const originalButtonText = submitButton.innerHTML;
        submitButton.innerHTML = 'Logging in...';
        submitButton.disabled = true;

        console.log('Sending login request...');
        // Send login request to server
        fetch('includes/login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                email: email,
                password: password
            })
        })
        .then(response => {
            console.log('Response received:', response.status);
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Login response:', data);
            if (data.success) {
                console.log('Login successful! User:', data.data.user);
                // Clear the form fields after successful login
                document.getElementById('loginEmail').value = '';
                document.getElementById('loginPassword').value = '';
                
                // Update navigation immediately
                updateNavigation(true, data.data.user);
                
                // Show success message
                showNotification('Login successful!');
                
                // Reload the page after a short delay
                setTimeout(() => {
                    window.location.reload();
                }, 1000);
            } else {
                console.log('Login failed:', data.message);
                showNotification(data.message || 'Invalid email or password');
            }
        })
        .catch(error => {
            console.error('Login Error:', error);
            showNotification('An error occurred during login. Please try again.');
        })
        .finally(() => {
            // Reset button state
            submitButton.innerHTML = originalButtonText;
            submitButton.disabled = false;
        });
    } else {
        console.log('Form validation failed');
        showNotification('Please fill in all fields');
    }
}

// Function to update navigation based on login status
function updateNavigation(isLoggedIn, userData = null) {
    console.log('Updating navigation, isLoggedIn:', isLoggedIn, 'userData:', userData);
    const authButtons = document.querySelector('.auth-buttons');
    const userMenu = document.querySelector('.user-menu');
    
    console.log('Auth buttons element:', authButtons);
    console.log('User menu element:', userMenu);
    
    if (isLoggedIn && userData) {
        console.log('User is logged in, updating UI');
        if (authButtons) {
            authButtons.style.display = 'none';
            console.log('Auth buttons hidden');
        } else {
            console.log('Auth buttons element not found');
        }
        
        if (userMenu) {
            userMenu.style.display = 'flex';
            console.log('User menu display set to flex');
            
            const userNameElement = userMenu.querySelector('.user-name');
            console.log('User name element:', userNameElement);
            
            if (userNameElement) {
                userNameElement.textContent = userData.name;
                console.log('User name updated:', userData.name);
            } else {
                console.log('User name element not found');
            }
            
            // Force a reflow to ensure the display change takes effect
            userMenu.offsetHeight;
            
            // Log computed styles
            const computedStyle = window.getComputedStyle(userMenu);
            console.log('User menu computed styles:', {
                display: computedStyle.display,
                visibility: computedStyle.visibility,
                opacity: computedStyle.opacity
            });
        } else {
            console.log('User menu element not found');
        }
    } else {
        console.log('User is not logged in, updating UI');
        if (authButtons) {
            authButtons.style.display = 'flex';
            console.log('Auth buttons shown');
        } else {
            console.log('Auth buttons element not found');
        }
        
        if (userMenu) {
            userMenu.style.display = 'none';
            console.log('User menu hidden');
        } else {
            console.log('User menu element not found');
        }
    }
}

// Function to handle logout
function logout() {
    console.log('Logout function called');
    fetch('includes/logout.php')
        .then(response => response.json())
        .then(data => {
            console.log('Logout response:', data);
            if (data.success) {
                showNotification('Logged out successfully');
                // Reload the page after a short delay
                setTimeout(() => {
                    window.location.href = 'index.php';
                }, 1000);
            } else {
                showNotification('Error logging out');
            }
        })
        .catch(error => {
            console.error('Logout Error:', error);
            showNotification('An error occurred during logout');
        });
}

// Signup function
function signup(event) {
    event.preventDefault();
    const name = document.getElementById('signupName').value;
    const email = document.getElementById('signupEmail').value;
    const password = document.getElementById('signupPassword').value;
    const confirmPassword = document.getElementById('confirmPassword').value;

    // Clear any existing error messages
    const errorElements = document.querySelectorAll('.error-message');
    errorElements.forEach(el => el.remove());

    // Validate password match
    if (password !== confirmPassword) {
        showError('confirmPassword', 'Passwords do not match');
        return;
    }

    // Validate password strength
    if (password.length < 8) {
        showError('signupPassword', 'Password must be at least 8 characters long');
        return;
    }

    if (name && email && password) {
        // Show loading state
        const submitButton = document.querySelector('#signupForm button[type="submit"]');
        const originalButtonText = submitButton.innerHTML;
        submitButton.innerHTML = 'Signing up...';
        submitButton.disabled = true;

        // Send signup request to server
        fetch('includes/register.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                name: name,
                email: email,
                password: password
            })
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                alert('Registration successful! Please login.');
                // Switch to login tab
                switchAuthTab('login');
                // Clear the form fields
                document.getElementById('signupName').value = '';
                document.getElementById('signupEmail').value = '';
                document.getElementById('signupPassword').value = '';
                document.getElementById('confirmPassword').value = '';
            } else {
                showError('signupEmail', data.message || 'Registration failed');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showError('signupEmail', 'An error occurred during registration. Please try again.');
        })
        .finally(() => {
            // Reset button state
            submitButton.innerHTML = originalButtonText;
            submitButton.disabled = false;
        });
    } else {
        if (!name) showError('signupName', 'Name is required');
        if (!email) showError('signupEmail', 'Email is required');
        if (!password) showError('signupPassword', 'Password is required');
    }
}

// Helper function to show error messages
function showError(fieldId, message) {
    const field = document.getElementById(fieldId);
    const errorDiv = document.createElement('div');
    errorDiv.className = 'error-message text-red-500 text-sm mt-1';
    errorDiv.textContent = message;
    field.parentNode.appendChild(errorDiv);
    field.classList.add('border-red-500');
}

// Add notification function
function showNotification(message) {
    const notification = document.getElementById('notification');
    notification.textContent = message;
    notification.style.display = 'block';
    
    // Hide notification after 2 seconds
    setTimeout(() => {
        notification.style.display = 'none';
    }, 2000);
}

// Add this function to check if elements exist in the DOM
function checkNavigationElements() {
    console.log('Checking navigation elements...');
    const authButtons = document.querySelector('.auth-buttons');
    const userMenu = document.querySelector('.user-menu');
    const userName = document.querySelector('.user-name');
    
    console.log('Navigation elements found:', {
        authButtons: !!authButtons,
        userMenu: !!userMenu,
        userName: !!userName
    });
    
    if (userMenu) {
        console.log('User menu classes:', userMenu.className);
        console.log('User menu style:', userMenu.style.cssText);
    }
}

// Add all other JavaScript functions from the original file here 