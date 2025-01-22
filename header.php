<?php 
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';
?>
<!-- Add Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

<style>
    /* Root variables for consistent theming */
    :root {
        --primary-color: #2c3e50;
        --secondary-color: #3498db;
        --accent-color: #e74c3c;
        --background-color: #f8f9fa;
        --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        --sidebar-width: 250px;
    --sidebar-width-large: 280px;
    --sidebar-width-small: 220px;
    --sidebar-width-mobile: 100px;
    }

    /* Static navbar container */
    .navbar-static {
        width: var(--sidebar-width);
        height: 100vh;
        background-color: #252729;
        position: fixed;
        top: 0;
        left: 0;
        overflow-y: auto;
        z-index: 1000;
    }
/* Logo/Brand section *//* Logo/Brand section */
.navbar-brand { 
    text-align: center;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.navbar-brand img {
    width: 200px;    /* Increased from 150px to 200px */
    height: 100px;
    margin-bottom: 10px;
}

.navbar-brand h3 {
    color: white;
    margin: 0;
    font-size: 24px;
    padding: 10px 0;
}

    /* Enhanced sidebar menu styles */
    .sidebar-menu {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .sidebar-menu li {
        display: block;
        margin: 8px 0;
        padding: 0;
        transition: all 0.3s ease;
    }

    .sidebar-menu li a {
        color: rgba(255, 255, 255, 0.8);
        text-decoration: none;
        font-size: 0.95rem;
        display: flex;
        align-items: center;
        padding: 12px 20px;
        transition: all 0.3s ease;
        border-radius: 5px;
        margin: 0 10px;
    }

    .sidebar-menu li a i {
        margin-right: 12px;
        font-size: 1.1rem;
        width: 20px;
        text-align: center;
    }

    .sidebar-menu li a:hover {
        background-color: var(--secondary-color);
        color: white;
        transform: translateX(5px);
    }

    .sidebar-menu li a.active {
        background-color: var(--secondary-color);
        color: white;
        box-shadow: var(--card-shadow);
    }

    /* Main content adjustment */

    /* Add: Container for the toggle button */
    .menu-toggle {
        display: none;
        position: fixed;
        top: 15px;
        left: 15px;
        z-index: 1001;
        background: var(--primary-color);
        border: none;
        color: white;
        padding: 10px;
        border-radius: 4px;
        cursor: pointer;
    }

    /* Responsive styles */
    @media (max-width: 768px) {
        .navbar-static {
            width: 0;
            transform: translateX(-100%);
            transition: transform 0.3s ease, width 0.3s ease;
        }

        .navbar-static.active {
            width: var(--sidebar-width);
            transform: translateX(0);
        }

        .main-content {
            margin-left: 0;
            width: 100%;
        }

        .menu-toggle {
            display: block;
        }

        /* Add: When sidebar is active, push content */
        .main-content.pushed {
            margin-left: var(--sidebar-width);
        }
    }

    /* Dark mode support */
    @media (prefers-color-scheme: dark) {
        .navbar-static {
            background: #1a1a1a;
        }

        .sidebar-menu li a {
            color: rgba(255, 255, 255, 0.7);
        }

        .sidebar-menu li a:hover,
        .sidebar-menu li a.active {
            background-color: #2980b9;
        }
    }

    /* Scrollbar styling */
    .navbar-static::-webkit-scrollbar {
        width: 6px;
    }

    .navbar-static::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
    }

    .navbar-static::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.2);
        border-radius: 3px;
    }

    .navbar-static::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.3);
    }
    
/* Add responsive sidebar widths */
@media screen and (min-width: 1440px) {
    :root {
        --sidebar-width: var(--sidebar-width-large);
    }
}

@media screen and (max-width: 1024px) {
    :root {
        --sidebar-width: var(--sidebar-width-small);
    }
}

@media screen and (max-width: 768px) {
    :root {
        --sidebar-width: 250px; /* Reset to default for mobile slide-out menu */
    }
    
    /* ... existing mobile styles ... */
}

/* Add submenu styles */
.submenu {
    margin: 5px 0;
    transition: all 0.3s ease;
}

.submenu li a {
    padding: 8px 20px;
    font-size: 0.9rem;
}

.submenu li a i {
    font-size: 0.9rem;
}

/* Rotate chevron when submenu is open */
.submenu-open .bi-chevron-down {
    transform: rotate(180deg);
}
</style>

<div class="navbar-static"><div class="navbar-brand">
    <img src="logo-image.png" alt="Tech Computer Education">
    <h3>E M S</h3>
</div>
    <ul class="sidebar-menu">
        <?php if($role == 'ADMIN') { ?>
            <li><a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
                <i class="bi bi-speedometer2"></i>Dashboard
            </a></li>
            <li>
                <a href="#" onclick="toggleSubmenu(event, 'employeeSubmenu')" class="<?php echo (basename($_SERVER['PHP_SELF']) == 'employee.php' || basename($_SERVER['PHP_SELF']) == 'add_employee.php') ? 'active' : ''; ?>">
                    <i class="bi bi-people"></i>Employees
                    <i class="bi bi-chevron-down" style="margin-left: auto;"></i>
                </a>
                <ul id="employeeSubmenu" class="submenu" style="display: none; list-style: none; padding-left: 20px;">
                    <li><a href="employee.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'employee.php' ? 'active' : ''; ?>">
                        <i class="bi bi-person-lines-fill"></i>View Employees
                    </a></li>
                    <li><a href="add_employee.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'add_employee.php' ? 'active' : ''; ?>">
                        <i class="bi bi-person-plus"></i>Add Employee
                    </a></li>
                </ul>
            </li>
            <li><a href="center.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'center.php' ? 'active' : ''; ?>">
                <i class="bi bi-building"></i>Centers
            </a></li>
            <li><a href="Department.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'Department.php' ? 'active' : ''; ?>">
                <i class="bi bi-diagram-3"></i>Departments
            </a></li>
            <li><a href="Designation.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'Designation.php' ? 'active' : ''; ?>">
                <i class="bi bi-person-badge"></i>Designations
            </a></li>
            <li><a href="role.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'role.php' ? 'active' : ''; ?>">
                <i class="bi bi-shield-lock"></i>Role
            </a></li>
            <li><a href="attendance.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'attendance.php' ? 'active' : ''; ?>">
                <i class="bi bi-calendar-check"></i>Attendance
            </a></li>
            <li><a href="salary.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'salary.php' ? 'active' : ''; ?>">
                <i class="bi bi-cash-stack"></i>Salary
            </a></li>
            <li><a href="report.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'report.php' ? 'active' : ''; ?>">
                <i class="bi bi-file-earmark-text"></i>Report
            </a></li>
            <li><a href="logout.php">
                <i class="bi bi-box-arrow-right"></i>Logout
            </a></li>
        <?php } else if($role == 'HR - ADMIN') { ?>
            <li><a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
                <i class="bi bi-speedometer2"></i>Profile
            </a></li>
            <li><a href="employee.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'employee.php' ? 'active' : ''; ?>">
                <i class="bi bi-people"></i>View Employee
            </a></li>
            <li><a href="add_employee.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'add_employee.php' ? 'active' : ''; ?>">
                <i class="bi bi-person-plus"></i>Add Employee
            </a></li>
            <li><a href="Designation.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'Designation.php' ? 'active' : ''; ?>">
                <i class="bi bi-person-badge"></i>Designation
            </a></li>
            <li><a href="Department.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'Department.php' ? 'active' : ''; ?>">
                <i class="bi bi-diagram-3"></i>Department
            </a></li>
            <li><a href="#" class="<?php echo basename($_SERVER['PHP_SELF']) == 'report.php' ? 'active' : ''; ?>">
                <i class="bi bi-file-earmark-text"></i>Report
            </a></li>
            <li><a href="logout.php">
                <i class="bi bi-box-arrow-right"></i>Logout
            </a></li>
        <?php } else if($role == 'EMPLOYEE') { ?>
            <li><a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
                <i class="bi bi-person-circle"></i>Profile
            </a></li>
            <li><a href="attendance.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'attendance.php' ? 'active' : ''; ?>">
                <i class="bi bi-calendar-check"></i>Attendance
            </a></li>
            <li><a href="salary.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'salary.php' ? 'active' : ''; ?>">
                <i class="bi bi-cash-stack"></i>Salary
            </a></li>
            <li><a href="report.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'report.php' ? 'active' : ''; ?>">
                <i class="bi bi-file-earmark-text"></i>Report
            </a></li>
            <li><a href="logout.php">
                <i class="bi bi-box-arrow-right"></i>Logout
            </a></li>
        <?php } else if($role == 'ACCOUNTS - ADMIN') { ?>
            <li><a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
                <i class="bi bi-speedometer2"></i>Dashboard
            </a></li>
            <li><a href="employee.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'employee.php' ? 'active' : ''; ?>">
                <i class="bi bi-people"></i>Employee Details
            </a></li>
            <li><a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
                <i class="bi bi-calendar-check"></i>Emp Attendance
            </a></li>
            <li><a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
                <i class="bi bi-cash-stack"></i>Emp Salary
            </a></li>
            <li><a href="dashboard.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'dashboard.php' ? 'active' : ''; ?>">
                <i class="bi bi-file-earmark-text"></i>Emp Report
            </a></li>
            <li><a href="loanad.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'loanad.php' ? 'active' : ''; ?>">
                <i class="bi bi-cash-stack"></i>Loan
            </a></li>
            <li><a href="loanpayment.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'loanpayment.php' ? 'active' : ''; ?>">
                <i class="bi bi-cash-stack"></i>Loan Payment
            </a></li>
            <li><a href="logout.php">
                <i class="bi bi-box-arrow-right"></i>Logout
            </a></li>
        <?php } ?>
    </ul>
</div>

<script>
function toggleSubmenu(event, submenuId) {
    event.preventDefault();
    const submenu = document.getElementById(submenuId);
    const parentLi = event.currentTarget.parentElement;
    
    if (submenu.style.display === 'none') {
        submenu.style.display = 'block';
        parentLi.classList.add('submenu-open');
    } else {
        submenu.style.display = 'none';
        parentLi.classList.remove('submenu-open');
    }
}

// Keep submenu open if on employee or add_employee page
document.addEventListener('DOMContentLoaded', function() {
    const currentPage = '<?php echo basename($_SERVER['PHP_SELF']); ?>';
    if (currentPage === 'employee.php' || currentPage === 'add_employee.php') {
        document.getElementById('employeeSubmenu').style.display = 'block';
        document.querySelector('a[onclick*="employeeSubmenu"]').parentElement.classList.add('submenu-open');
    }
});
</script>
