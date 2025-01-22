
    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>

    <div class="sidebar">
        <div class="sidebar-header">
            <h2>Employee Portal</h2>
        </div>
        
        <div class="sidebar-item active">
            <i>📊</i>
            <span ><a href="Dashboard.php" style="color:white;"> Dashboard</a></span>
        </div>
        <div class="sidebar-item">
            <i>🏠</i>
            <a href="C:\xampp\htdocs\ems\home\index.html" style="text-decoration: none; color: inherit;">
                <span ><a href="center.php" style="color:white;"> Center</a></span>
            </a>
        </div>
        <div class="sidebar-item">
            <i>📝</i>
            <span ><a href="role.php" style="color:white;"> Role</a></span>
        </div>
        <div class="sidebar-item">
            <i>👥</i>
            <span ><a href="employee.php" style="color:white;"> Employee</a></span>
        </div>
        <!-- <div class="sidebar-item">
            <i>⏰</i>
            <a href="attendance/index.html" style="text-decoration: none; color: inherit;">
                <span>Attendance & Leaves</span>
            </a>
        </div> -->
   
        <div class="sidebar-item" id="logoutBtn">
            <i>🚪</i>
            <span> <a href="logout.php" style="color:white;"> Log Out</a></span>
        </div>
    </div>

    
    <button class="theme-toggle" onclick="toggleTheme()">🌓</button>

    <script>
        function updateDateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString('en-US', { 
                hour: 'numeric', 
                minute: '2-digit',
                hour12: true 
            });
            const dateString = now.toLocaleDateString('en-US', { 
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
            document.getElementById('datetime').textContent = 
                `${timeString} - ${dateString}`;
        }

        // Update time immediately and then every second
        updateDateTime();
        setInterval(updateDateTime, 1000);

        // Add this new function for theme switching
        function toggleTheme() {
            const root = document.documentElement;
            const currentPrimary = getComputedStyle(root).getPropertyValue('--primary-color');
            
            const themes = {
                default: {
                    primary: '#2c3e50',
                    secondary: '#3498db',
                    accent: '#e74c3c',
                    background: '#f8f9fa'
                },
                dark: {
                    primary: '#1a1a1a',
                    secondary: '#2980b9',
                    accent: '#c0392b',
                    background: '#2c3e50'
                },
                light: {
                    primary: '#3498db',
                    secondary: '#2ecc71',
                    accent: '#e67e22',
                    background: '#ffffff'
                }
            };

            // Cycle through themes
            if (currentPrimary.trim() === themes.default.primary) {
                setTheme(themes.dark);
            } else if (currentPrimary.trim() === themes.dark.primary) {
                setTheme(themes.light);
            } else {
                setTheme(themes.default);
            }
        }

        function setTheme(theme) {
            const root = document.documentElement;
            root.style.setProperty('--primary-color', theme.primary);
            root.style.setProperty('--secondary-color', theme.secondary);
            root.style.setProperty('--accent-color', theme.accent);
            root.style.setProperty('--background-color', theme.background);
        }

        // Add greeting based on time of day
        function updateGreeting() {
            const hour = new Date().getHours();
            const welcomeMessage = document.querySelector('.welcome-message h2');
            let greeting = '';
            
            if (hour >= 5 && hour < 12) greeting = 'Good morning';
            else if (hour >= 12 && hour < 18) greeting = 'Good afternoon';
            else greeting = 'Good evening';
            
            welcomeMessage.textContent = `${greeting}, Sara 👋`;
        }

        // Call updateGreeting initially and set up intervals
        updateGreeting();
        setInterval(updateGreeting, 1800000); // Update every 30 minutes

        // Add this function for mobile menu toggle
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            sidebar.classList.toggle('active');
        }

        // Add click event listeners for sidebar items
        document.querySelectorAll('.sidebar-item').forEach(item => {
            item.addEventListener('click', function() {
                // Remove active class from all items
                document.querySelectorAll('.sidebar-item').forEach(i => {
                    i.classList.remove('active');
                });
                // Add active class to clicked item
                this.classList.add('active');
            });
        });

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.querySelector('.sidebar');
            const menuToggle = document.querySelector('.menu-toggle');
            
            if (window.innerWidth <= 768) {
                if (!sidebar.contains(event.target) && !menuToggle.contains(event.target)) {
                    sidebar.classList.remove('active');
                }
            }
        });

        // Add logout functionality
       
    </script>

