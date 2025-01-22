<?php
session_start();
include './config/db.php';
if($_SESSION['logged_in'] == false){
   header("Location: login.php");
}



// Construct the SQL query




    

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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
         .vertical-list {
        list-style: none;
        padding: 0;
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        gap: 10px;
    }

    .vertical-list li {
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        width: fit-content;
    }
    .sidebar-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.sidebar-menu li {
    display: block;
    margin: 20px 0; /* Adjust the space between items */
    padding-left: 20px; /* Indent items */
}

.main-content {
    margin-left: 280px;
    padding: 20px;
    transition: all 0.3s ease;
    flex: 1;
    display: flex;
    flex-direction: column;
    min-height: 100vh;
}
.sidebar-menu li a {
    color: white;
    text-decoration: none;
    font-size: 16px; /* Adjust font size */
    display: block;
    padding: 10px;
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.sidebar-menu li a:hover {
    background-color: #3498db; /* Highlight on hover */
    color: white; /* Maintain white text on hover */
}
.form {
    max-width: 600px;
    padding: 20px;
    border: 1px solid #ddd;
    border-radius: 5px;
    background: #f9f9f9;
  }

  .form-group {
    margin-bottom: 15px;
  }

  .form-group label {
    display: block;
    margin-bottom: 5px;
  }

  .form-group input,
  .form-group textarea {
    width: 100%;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
  }

  .btn {
    padding: 8px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .btn-primary {
    background-color: #007bff;
    color: white;
  }

  .btn-secondary {
    background-color: #6c757d;
    color: white;
  }

.dashboard-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    margin-bottom: 20px;
    background: white;
    overflow: hidden;
}

.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0,0,0,0.2);
}

.card-icon {
    font-size: 2.5rem;
    color: #3498db;
    margin-bottom: 15px;
}

.card-title {
    color: #2c3e50;
    font-weight: 600;
    margin-bottom: 15px;
}

.card-text.counter {
    font-size: 2rem;
    font-weight: bold;
    color: #3498db;
    margin: 15px 0;
}

.dashboard-card .btn {
    border-radius: 25px;
    padding: 8px 25px;
    font-weight: 500;
    text-transform: uppercase;
    font-size: 0.9rem;
    margin-top: 10px;
    transition: all 0.3s ease;
}

.dashboard-card .btn:hover {
    transform: scale(1.05);
}

/* Add different colors for different cards */
.dashboard-card:nth-child(1) .card-icon { color: #3498db; }
.dashboard-card:nth-child(2) .card-icon { color: #2ecc71; }
.dashboard-card:nth-child(3) .card-icon { color: #e74c3c; }
.dashboard-card:nth-child(4) .card-icon { color: #f1c40f; }
.dashboard-card:nth-child(5) .card-icon { color: #9b59b6; }
.navbar-brand{
            padding-left:15px;
        }
    </style>
</head>
<body>
    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
    

<?php  include('header.php');?>

   

   

<div class="main-content">
    <?php if($_SESSION['role']=='EMPLOYEE') {?>
 <div>
 <a href="EditProfile.php?id=<?php echo $_SESSION['id']; ?>"  style="float:right;" class="btn btn-danger">Edit</a>

 </div>   
<div>

<div class="container" id="miniview">
  <div class="row">
    <div class="col-sm">
     <h3>Name :<span style="color:blue;"><?php echo $_SESSION['ename']; ?></span></h3>
     <h3>EsCode : <span style="color:blue;"><?php echo $_SESSION['escode']; ?></span></h3>
     <h3>Designation: <span style="color:blue;"><?php echo $_SESSION['designation']; ?></span></h3>
     <h3>Joining date:<span style="color:blue;"><?php echo
     date('d-m-Y', strtotime($_SESSION['emp_joining_date'])) ; ?></span> </h3>
     <h3>Date of Birth: <span style="color:blue;"><?php echo 
     date('d-m-Y', strtotime($_SESSION['emp_dob'])); ?></span></h3>
     <h3>Email:<span style="color:blue;"><?php echo $_SESSION['email']; ?></span> </h3>
     <h3>Phone no :<span style="color:blue;"><?php echo $_SESSION['emp_phone_no']; ?></span> </h3>
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
    <div class="col-sm">
    <img src="images.jpg" class="img-thumbnail" alt="..." style="width:35%; ">
    </div>
   
  </div>
</div>
    
<div id="tabularview" style="display:none;">
    <button type="button" class="btn btn-primary" onclick ="getminin()" style="    float: right;
    width: 6%;">Back</button>
    <?php 
// Assuming session is already started somewhere before this code


// Get the employee ID from the session
$empid = $_SESSION['id']; 

// Validate or sanitize the ID (to prevent SQL injection)
if (!is_numeric($empid)) {
    die("Invalid employee ID.");
}

// Query to fetch the employee data
$sql = "SELECT empid, ename, designation, role, emp_joining_date, emp_dob, emp_gender, marital_status,
        emp_email, emp_phone_no, emp_alt_contact_no, emp_address, emp_city, emp_pincode, emp_salary, centre_id,
        incentive, emp_status, bank_name, bank_branch, bank_account_name, bank_account_no, ifsc_code, login_name,
        password, profile_picture, department, EmpCode 
        FROM employee_master WHERE empid = '$empid'";

$result = $conn->query($sql);

// Check if a record was found
if ($result && $result->num_rows > 0) {
    // Fetch the data
    $row = $result->fetch_assoc(); 
    ?>

    <!-- Display the form -->
    <form class="form">
        <div class="form-group">
            <label for="empid">Empid</label>
            <input type="text" id="empid" name="empid" value="<?php echo htmlspecialchars($row['empid']); ?>" readonly>
        </div>

        <div class="form-group">
            <label for="ename">Ename</label>
            <input type="text" id="ename" name="ename" value="<?php echo htmlspecialchars($row['ename']); ?>" readonly>
        </div>

        <div class="form-group">
            <label for="designation">Designation</label>
            <input type="text" id="designation" name="designation" value="<?php echo htmlspecialchars($row['designation']); ?>" readonly>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <input type="text" id="role" name="role" value="<?php echo htmlspecialchars($row['role']); ?>" readonly>
        </div>

        <div class="form-group">
            <label for="emp_joining_date">Emp Joining Date</label>
            <input type="text" id="emp_joining_date" name="emp_joining_date" value="<?php echo htmlspecialchars($row['emp_joining_date']); ?>" readonly>
        </div>

        <div class="form-group">
            <label for="emp_dob">Emp Dob</label>
            <input type="text" id="emp_dob" name="emp_dob" value="<?php echo htmlspecialchars($row['emp_dob']); ?>" readonly>
        </div>

        <div class="form-group">
            <label for="emp_gender">Emp Gender</label>
            <input type="text" id="emp_gender" name="emp_gender" value="<?php echo htmlspecialchars($row['emp_gender']); ?>" readonly>
        </div>

        <div class="form-group">
            <label for="emp_email">Emp Email</label>
            <input type="email" id="emp_email" name="emp_email" value="<?php echo htmlspecialchars($row['emp_email']); ?>" readonly>
        </div>

        <div class="form-group">
            <label for="emp_address">Emp Address</label>
            <textarea id="emp_address" name="emp_address" readonly><?php echo htmlspecialchars($row['emp_address']); ?></textarea>
        </div>

        <div class="form-group">
            <label for="EmpCode">Emp Code</label>
            <input type="text" id="EmpCode" name="EmpCode" value="<?php echo htmlspecialchars($row['EmpCode']); ?>" readonly>
        </div>
    </form>

<?php 
} else {
    echo "<p>No record found for the provided employee ID.</p>";
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
        <div class="card-body text-center">
          <div class="card-icon">
            <i class="fas fa-users"></i>
          </div>
          <h5 class="card-title">Total Employee</h5>
          <p class="card-text counter">
            <?php 
              $sql = "SELECT count(empid) as id from employee_master";
              $result = $conn->query($sql);
              $row = $result->fetch_assoc();
              echo $row['id'];
            ?>
          </p>
          <a href="employee.php" class="btn btn-primary stretched-link">View Employees</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card dashboard-card">
        <div class="card-body text-center">
          <div class="card-icon">
            <i class="fas fa-building"></i>
          </div>
          <h5 class="card-title">Total Centers</h5>
          <p class="card-text counter">
            <?php
              $sql1 = "SELECT count(centre_code) as cencode from centre_master";
              $result1 = $conn->query($sql1);
              $row1 = $result1->fetch_assoc();
              echo $row1['cencode'];
            ?>
          </p>
          <a href="center.php" class="btn btn-primary stretched-link">View Centers</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card dashboard-card">
        <div class="card-body text-center">
          <div class="card-icon">
            <i class="fas fa-cubes"></i>
          </div>
          <h5 class="card-title">Total Departments</h5>
          <p class="card-text counter">
            <?php
              $sql2 = "SELECT count(depid) as dep FROM `department`";
              $result2 = $conn->query($sql2);
              $row2 = $result2->fetch_assoc();
              echo $row2['dep'];
            ?>
          </p>
          <a href="Department.php" class="btn btn-primary stretched-link">View Departments</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card dashboard-card">
        <div class="card-body text-center">
          <div class="card-icon">
            <i class="fas fa-sitemap"></i>
          </div>
          <h5 class="card-title">Total Designations</h5>
          <p class="card-text counter">
            <?php
              $sql3 = "SELECT COUNT(*)  AS designation FROM `designation`";
              $result3 = $conn->query($sql3);
              $row3 = $result3->fetch_assoc();
              echo $row3['designation'];
            ?>
          </p>
          <a href="Designation.php" class="btn btn-primary stretched-link">View Designations</a>
        </div>
      </div>
    </div>
    <div class="col-sm-4">
      <div class="card dashboard-card">
        <div class="card-body text-center">
          <div class="card-icon">
            <i class="fas fa-user-tag"></i>
          </div>
          <h5 class="card-title">Total Roles</h5>
          <p class="card-text counter">
            <?php
              $sql4 = "SELECT COUNT(*) AS userid FROM role;";
              $result4 = $conn->query($sql4);
              $row4 = $result4->fetch_assoc();
              echo $row4['userid'];
            ?>
          </p>
          <a href="role.php" class="btn btn-primary stretched-link">View Roles</a>
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
