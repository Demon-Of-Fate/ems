<?php
session_start();
include './config/db.php';
if($_SESSION['logged_in'] == false){
   header("Location: login.php");
}

// Add Bootstrap Icons CDN
echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style1.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --background-color: #f8f9fa;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f5f7fa;
        }

        .sidebar {
            background: var(--primary-color);
            box-shadow: var(--card-shadow);
            border-radius: 0 15px 15px 0;
        }

        /* Copy all styles from dashboard.php */
        .navbar-container {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background: var(--primary-color);
            color: white;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: var(--card-shadow);
        }

        .navbar-brand {
            padding: 1.5rem;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .navbar-brand h3 {
            color: white;
            font-size: 1.5rem;
            margin: 0;
            font-weight: 600;
            letter-spacing: 2px;
        }

        .nav-menu {
            padding: 1rem 0;
        }

        .nav-item {
            padding: 0.8rem 1.5rem;
            display: flex;
            align-items: center;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            text-decoration: none;
        }

        .nav-item.active {
            background: var(--secondary-color);
            color: white;
        }

        .nav-item i {
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .menu-toggle {
            position: fixed;
            top: 1rem;
            left: 1rem;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.5rem;
            border-radius: 5px;
            cursor: pointer;
            z-index: 1001;
            display: none;
        }

        .main-content {
            margin-left: 250px;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        @media (max-width: 768px) {
            .navbar-container {
                transform: translateX(-100%);
            }

            .navbar-container.active {
                transform: translateX(0);
            }

            .menu-toggle {
                display: block;
            }

            .main-content {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
    <nav class="navbar-container">
        <div class="navbar-brand">
            <h3>E M S</h3>
        </div>
        <div class="nav-menu">
            <?php if($_SESSION['role']=='ADMIN') { ?>
                <a href="dashboard.php" class="nav-item">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
                <a href="employee.php" class="nav-item">
                    <i class="bi bi-people"></i>
                    Employees
                </a>
                <a href="center.php" class="nav-item">
                    <i class="bi bi-building"></i>
                    Centers
                </a>
                <a href="Department.php" class="nav-item">
                    <i class="bi bi-diagram-3"></i>
                    Departments
                </a>
                <a href="Designation.php" class="nav-item">
                    <i class="bi bi-person-badge"></i>
                    Designations
                </a>
                <a href="attendance.php" class="nav-item active">
                    <i class="bi bi-calendar-check"></i>
                    Attendance
                </a>
                <a href="salary.php" class="nav-item">
                    <i class="bi bi-cash-stack"></i>
                    Salary
                </a>
                <a href="report.php" class="nav-item">
                    <i class="bi bi-file-earmark-text"></i>
                    Report
                </a>
            <?php } else { ?>
                <a href="dashboard.php" class="nav-item">
                    <i class="bi bi-person-circle"></i>
                    Profile
                </a>
                <a href="attendance.php" class="nav-item active">
                    <i class="bi bi-calendar-check"></i>
                    Attendance
                </a>
                <a href="salary.php" class="nav-item">
                    <i class="bi bi-cash-stack"></i>
                    Salary
                </a>
                <a href="report.php" class="nav-item">
                    <i class="bi bi-file-earmark-text"></i>
                    Report
                </a>
            <?php } ?>
            <a href="logout.php" class="nav-item">
                <i class="bi bi-box-arrow-right"></i>
                Logout
            </a>
        </div>
    </nav>

    <div class="main-content">
        <!-- Your attendance content will go here -->
    </div>

    <button class="theme-toggle" onclick="toggleTheme()">🌓</button>

    <script>
        // Mobile menu toggle
        function toggleSidebar() {
            const navbar = document.querySelector('.navbar-container');
            navbar.classList.toggle('active');
        }

        // Theme toggle functionality
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
    </script>
</body>
</html>
