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
    <title>Employee Dashboard</title>
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

        .card {
            border: none;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .btn {
            border-radius: 8px;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: var(--secondary-color);
            border: none;
        }

        .btn-primary:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        /* Profile section improvements */
        #miniview {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: var(--card-shadow);
        }

        #miniview h3 {
            font-size: 1.2rem;
            margin: 15px 0;
        }

        #miniview span {
            font-weight: 500;
        }

        .img-thumbnail {
            border-radius: 50%;
            border: 3px solid var(--secondary-color);
            padding: 3px;
        }

        /* Form improvements */
        .form {
            background: white;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
        }

        .form-group input,
        .form-group textarea {
            border-radius: 8px;
            border: 1px solid #e1e1e1;
            padding: 12px;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--secondary-color);
            outline: none;
        }

        /* Dashboard cards */
        .dashboard-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin: 15px 0;
            box-shadow: var(--card-shadow);
        }

        .card-title {
            color: var(--primary-color);
            font-weight: 600;
        }

        .card-text {
            font-size: 2rem;
            font-weight: 700;
            color: var(--secondary-color);
        }

        /* Add these new navbar styles after your existing styles */
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

        /* Update the existing theme-toggle button style */
        .theme-toggle {
            position: fixed;
            bottom: 1rem;
            right: 1rem;
            background: var(--primary-color);
            color: white;
            border: none;
            padding: 0.8rem;
            border-radius: 50%;
            cursor: pointer;
            z-index: 1001;
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            transform: scale(1.1);
        }

        /* Add these new styles for the view details section */
        .form {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin: 1rem 0;
            box-shadow: var(--card-shadow);
        }

        .form-group {
            margin-bottom: 1.5rem;
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }

        .form-group label {
            font-weight: 500;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            background-color: #f8f9fa;
            color: #495057;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
            outline: none;
        }

        .form-group input[readonly],
        .form-group textarea[readonly] {
            background-color: #f8f9fa;
            cursor: default;
        }

        .back-button {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.5rem 1rem;
            background-color: var(--secondary-color);
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .back-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .details-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #eee;
        }

        .details-header h2 {
            color: var(--primary-color);
            font-weight: 600;
            margin: 0;
        }

        .details-section {
            position: relative;
            padding: 2rem;
            background: white;
            border-radius: 15px;
            box-shadow: var(--card-shadow);
        }

        @media (max-width: 768px) {
            .form-group {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
    <!-- <nav class="navbar-container">
        <div class="navbar-brand">
            <h3>E M S</h3>
        </div>
        <div class="nav-menu">
            <?php if($_SESSION['role']=='ADMIN') { ?>
                <a href="dashboard.php" class="nav-item active">
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
                <a href="attendance.php" class="nav-item">
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
                <a href="dashboard.php" class="nav-item active">
                    <i class="bi bi-person-circle"></i>
                    Profile
                </a>
                <a href="attendance.php" class="nav-item">
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
    </nav> -->
    <?php include 'header.php'; ?>

    <div class="main-content">
    <?php if($_SESSION['role']=='EMPLOYEE') {?>
 <div>
 <a href="EditProfile.php?id=<?php echo $_SESSION['id']; ?>"  style="float:right;" class="btn btn-danger">Edit</a>

 </div>   
<div>

<div class="container" id="miniview">
  <div class="row">
    <div class="col-sm">
    <img src="images.jpg" class="img-thumbnail" alt="..." style="width:35%; ">
     <h3>Name :<span style="color:blue;"><?php echo $_SESSION['ename']; ?></span></h3>
     <h3>EsCode : <span style="color:blue;"><?php echo $_SESSION['escode']; ?></span></h3>
     <h3>Designation: <span style="color:blue;"><?php echo $_SESSION['designation']; ?></span></h3>
     <h3>Joining date:<span style="color:blue;"><?php echo $_SESSION['emp_joining_date']; ?></span> </h3>
     <h3>Date of Birth: <span style="color:blue;"><?php echo $_SESSION['emp_dob']; ?></span></h3>
     <h3>Email:<span style="color:blue;"><?php echo $_SESSION['email']; ?></span> </h3>
     <h3>Phone no :<span style="color:blue;"><?php echo $_SESSION['emp_phone_no']; ?></span> </h3>
    </div>
    <div class="col-sm">
    <h3>Address: <span style="color:blue;"><?php echo $_SESSION['emp_address']; ?></span></h3>
    <h3>Salary:<span style="color:blue;"><?php echo $_SESSION['emp_salary']; ?></span> </h3>
    <h3>Center Name: <span style="color:blue;">
        <?php
        $center_code = $_SESSION['center']; // Get the center code from session
        $sql = "SELECT centre_name FROM centre_master WHERE centre_code = '$center_code'";
        $result = $conn->query($sql);
    
        // Check if results exist and display them
        if ($result && $result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo $row['centre_name'];
            }
        } ?></span></h3>
        <button  class="btn btn-primary" onclick ="getdetails()">View Details</button>
    </div>
   
  </div>
</div>
    
<div id="tabularview" style="display:none;" class="details-section">
    <div class="details-header">
        <h2>Employee Details</h2>
        <button type="button" class="back-button" onclick="getminin()">
            <i class="bi bi-arrow-left"></i> Back
        </button>
    </div>

    <?php 
    $empid = $_SESSION['id']; 
    if (!is_numeric($empid)) {
        die("Invalid employee ID.");
    }

    $sql = "SELECT * FROM employee_master WHERE empid = '$empid'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc(); 
    ?>
    <form class="form">
        <div class="form-group">
            <div>
                <label for="empid">Employee ID</label>
                <input type="text" id="empid" name="empid" value="<?php echo htmlspecialchars($row['empid']); ?>" readonly>
            </div>
            <div>
                <label for="ename">Employee Name</label>
                <input type="text" id="ename" name="ename" value="<?php echo htmlspecialchars($row['ename']); ?>" readonly>
            </div>
        </div>

        <div class="form-group">
            <div>
                <label for="designation">Designation</label>
                <input type="text" id="designation" name="designation" value="<?php echo htmlspecialchars($row['designation']); ?>" readonly>
            </div>
            <div>
                <label for="role">Role</label>
                <input type="text" id="role" name="role" value="<?php echo htmlspecialchars($row['role']); ?>" readonly>
            </div>
        </div>

        <div class="form-group">
            <div>
                <label for="emp_joining_date">Joining Date</label>
                <input type="text" id="emp_joining_date" name="emp_joining_date" value="<?php echo htmlspecialchars($row['emp_joining_date']); ?>" readonly>
            </div>
            <div>
                <label for="emp_dob">Date of Birth</label>
                <input type="text" id="emp_dob" name="emp_dob" value="<?php echo htmlspecialchars($row['emp_dob']); ?>" readonly>
            </div>
        </div>

        <div class="form-group">
            <div>
                <label for="emp_gender">Gender</label>
                <input type="text" id="emp_gender" name="emp_gender" value="<?php echo htmlspecialchars($row['emp_gender']); ?>" readonly>
            </div>
            <div>
                <label for="emp_email">Email</label>
                <input type="email" id="emp_email" name="emp_email" value="<?php echo htmlspecialchars($row['emp_email']); ?>" readonly>
            </div>
        </div>

        <div class="form-group">
            <div>
                <label for="emp_phone_no">Phone Number</label>
                <input type="text" id="emp_phone_no" name="emp_phone_no" value="<?php echo htmlspecialchars($row['emp_phone_no']); ?>" readonly>
            </div>
            <div>
                <label for="EmpCode">Employee Code</label>
                <input type="text" id="EmpCode" name="EmpCode" value="<?php echo htmlspecialchars($row['EmpCode']); ?>" readonly>
            </div>
        </div>

        <div class="form-group">
            <div>
                <label for="emp_address">Address</label>
                <textarea id="emp_address" name="emp_address" readonly rows="3"><?php echo htmlspecialchars($row['emp_address']); ?></textarea>
            </div>
            <div>
                <label for="emp_city">City</label>
                <input type="text" id="emp_city" name="emp_city" value="<?php echo htmlspecialchars($row['emp_city']); ?>" readonly>
            </div>
        </div>
    </form>
    <?php 
    } else {
        echo "<p class='text-center'>No record found for the provided employee ID.</p>";
    }
    ?>
</div>
<div>
    
</div>

    <?php }else {?>
<div>
    <h3><?php echo $_SESSION['role'] ?></h3></div>
<h3>Welcome <?php echo $_SESSION['ename'] ?></h3>

<div class="container">
  <div class="row">
    <div class="col-sm-4">
    <div class="card dashboard-card">
        <div class="card-body">
            <h5 class="card-title"><i class="bi bi-people"></i> Total Employee</h5>
            <p class="card-text"><?php $sql = "SELECT  count(empid) as id from  employee_master ";
$result = $conn->query($sql);
$result->num_rows; 
$row = $result->fetch_assoc();
echo $row['id']
 ?></p>
            <a href="employee.php" class="btn btn-primary">View Employees</a>
        </div>
    </div>
    </div>
    <div class="col-sm-4">
    <div class="card dashboard-card">
        <div class="card-body">
            <h5 class="card-title"><i class="bi bi-building"></i> Total Center</h5>
            <p class="card-text"><?php $sql1 = "SELECT  count(centre_code) as cencode from  centre_master ";
$result1 = $conn->query($sql1);
$result1->num_rows; 
$row1 = $result1->fetch_assoc();
echo $row1['cencode'];
 ?></p>
            <a href="center.php" class="btn btn-primary">View Centers</a>
        </div>
    </div>
    </div>
    <div class="col-sm-4">
    <div class="card dashboard-card">
        <div class="card-body">
            <h5 class="card-title"><i class="bi bi-layers"></i> Total department</h5>
            <p class="card-text"><?php $sql2 = "SELECT count(depid) as dep FROM `department`";
$result2 = $conn->query($sql2);
$result2->num_rows; 
$row2 = $result2->fetch_assoc();
echo $row2['dep'];
 ?></p>
            <a href="Department.php" class="btn btn-primary">View Departments</a>
        </div>
    </div>
    </div>
    <div class="col-sm-4 mt-2">
    <div class="card dashboard-card">
        <div class="card-body">
            <h5 class="card-title"><i class="bi bi-person-badge"></i> Total Designation</h5>
            <p class="card-text"><?php $sql3 = "SELECT COUNT(desigid)  as ids FROM `designation`";
$result3 = $conn->query($sql3);
$result3->num_rows; 
$row3 = $result3->fetch_assoc();
echo $row3['ids'];
 ?>.</p>
            <a href="Designation.php" class="btn btn-primary">View Designations</a>
        </div>
    </div>
    </div>
  </div>
</div>
        <?php }?>
</div>
    


    <button class="theme-toggle" onclick="toggleTheme()">🌓</button>

    <script>
        
        function getdetails()
        {
            
            document.getElementById('miniview').style.display='none'
            document.getElementById('tabularview').style.display='block'
        }
        function getminin()
        {
            document.getElementById('miniview').style.display='block'
            document.getElementById('tabularview').style.display='none'
        }
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
</body>
</html>
