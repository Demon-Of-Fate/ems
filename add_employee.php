<?php
session_start();
include './config/db.php';
if($_SESSION['logged_in'] == false){
   header("Location: login.php");
}



$sql = "SELECT * FROM `role`";
$role = $conn->query($sql);
$roles = $role->fetch_all(MYSQLI_ASSOC);

$query = "SELECT * FROM  `centre_master`";
$centers = $conn->query($query);
$center_master = $centers->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <!-- jQuery CDN link -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style1.css">
    <style>


.sidebar-menu {
    list-style: none;
    padding: 0;
    margin: 0;
}

.main-content{
    margin-left:280px;
}
.sidebar-menu li {
    display: block;
    margin: 20px 0; /* Adjust the space between items */
    padding-left: 20px; /* Indent items */
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
.container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.container span {
    font-size: 24px;
    font-weight: bold;
    margin-bottom: 20px;
    display: block;
}

a.btn {
    background-color: #007bff;
    color: white;
    padding: 10px 15px;
    text-decoration: none;
    border-radius: 5px;
    margin-bottom: 20px;
    display: inline-block;
}

a.btn:hover {
    background-color: #0056b3;
}

form {
    margin-top: 20px;
}

.form-section {
    margin-bottom: 30px;
}

.form-section h3 {
    margin-bottom: 10px;
    font-size: 20px;
    color: #333;
}

.form-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    font-size: 14px;
    color: #333;
}

.form-group input, .form-group select, .form-group textarea {
    width: 100%;
    padding: 10px;
    margin-top: 5px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.form-group select {
    cursor: pointer;
}

textarea {
    resize: vertical;
}

.form-actions {
    display: flex;
    justify-content: space-between;
}

.form-actions button {
    padding: 10px 20px;
    border: none;
    cursor: pointer;
    border-radius: 5px;
}

.form-actions .btn-primary {
    background-color: #28a745;
    color: white;
}

.form-actions .btn-primary:hover {
    background-color: #218838;
}

.form-actions .btn-secondary {
    background-color: #6c757d;
    color: white;
}

.form-actions .btn-secondary:hover {
    background-color: #5a6268;
}
.navbar-brand{
            padding:25px;
        }

    </style>
</head>
<body>

    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
    
<?php  include('header.php');?>


        
   

        <?php include('backbtn.php'); ?>
    <div class="main-content">
    
    <div class="container">
    <span>Add Employee</span>
    

    <form id="employeeForm" class="employee-form" method="post">
        <!-- Personal Information -->
<div class="form-section">
    <h3>Personal Information</h3>
    <div class="form-grid">
        <div class="form-group">


          <label for="emp_name">Full Name*</label>
            <input type="text" id="emp_name" name="emp_name" required>
        </div>
        <div class="form-group">
            <label for="emp_dob">Date of Birth*</label>
            <input type="date" id="emp_dob" name="emp_dob"  required>
        </div>
        <div class="form-group">
            <label for="gender">Gender*</label>
            <select id="gender" name="gender" required>
                            <option value="">Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
        </div>
        <div class="form-group">
            <label for="marital_status">Marital Status</label>
            <select id="marital_status" name="marital_status">
                            <option value="">Select Martial status</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="divorced">Divorced</option>
                            <option value="widowed">Widowed</option>
                        </select>
        </div>
    </div>
</div>

<!-- Contact Information -->
<div class="form-section">
    <h3>Contact Information</h3>
    <div class="form-grid">
        <div class="form-group">
            <label for="emp_email">Email*</label>
            <input type="email" id="emp_email" name="emp_email" value="" required>
        </div>
        <div class="form-group">
            <label for="emp_phone">Phone*</label>
            <input type="tel" id="emp_phone" name="emp_phone" value="" required>
        </div>
        <div class="form-group">
            <label for="alternate_contact_phone">Alternate Phone</label>
            <input type="tel" id="alternate_contact_phone" name="alternate_contact_phone" value="">
        </div>
        <div class="form-group">
            <label for="emp_address">Address*</label>
            <textarea id="emp_address" name="emp_address" required></textarea>
        </div>
        <div class="form-group">
            <label for="emp_city">City*</label>
            <input type="text" id="emp_city" name="emp_city" value="" required>
        </div>
        <div class="form-group">
            <label for="emp_pincode">Pincode*</label>
            <input type="text" id="emp_pincode" name="emp_pincode" value="" required>
        </div>
    </div>
</div>

<!-- Employment Details -->
<div class="form-section">
    <h3>Employment Details</h3>
    <div class="form-grid">
        <div class="form-group">
            <label for="emp_designation">Designation*</label>
            
            <select name="" id="emp_designation" required>
            <option value="">Select Designation</option>
            <?php
        // Che$sql = "SELECT id, role_name FROM roles"; // assuming you have a 'roles' table with 'id' and 'role_name' columns
        $sql = "SELECT * FROM designation";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // Loop through the results and create options
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['designation'] . "'>" . $row['designation'] . "</option>";
            }
        } else {
            echo "<option value=''>No roles available</option>";
        }
        ?>
        </select>
        </div>
        <div class="form-group">
                        <label for="empcode">Emp code*</label>
                        <input type="text" id="empcode" name="Emp_Code" value="" required>
                    </div>
        <div class="form-group">
            <label for="emp_dept">Department*</label>
           
            <select name="" id="emp_dept" required>
            <option value="">Select Dept</option>
            <?php
        // Che$sql = "SELECT id, role_name FROM roles"; // assuming you have a 'roles' table with 'id' and 'role_name' columns
        $sql = "SELECT * FROM department";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // Loop through the results and create options
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['Department'] . "'>" . $row['Department'] . "</option>";
            }
        } else {
            echo "<option value=''>No roles available</option>";
        }
        ?>
        </select>
        </div>
        <div class="form-group">
            <label for="emp_joining">Joining Date*</label>
            <input type="date" id="emp_joining" name="emp_joining" value="" required>
        </div>
        <div class="form-group">
            <label for="emp_salary">Salary*</label>
            <input type="text" id="emp_salary" name="emp_salary" value="" required>
        </div>
        <div class="form-group">
            <label for="incentive">Incentive</label>
            <select name="incentive" id="incentive">
            <option value =''>select incentive</option>
            <option value ='yes'>Yes</option>
            <option value ='no'>No</option>
            </select>
        </div>
        <div class="form-group">
            <label for="center_id">Center ID</label>
            <select id="center_id" name="center_id" required>
                <option value="">Select Center id</option>
                            <?php foreach($center_master as $center): ?>
                            <option value="<?= $center['centre_code'] ?>"> <?= $center['centre_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
        </div>
        <div class="form-group">
            <label for="emp_status">Status*</label>
            <select id="emp_status" name="emp_status" required>
            <option value="">Select status</option>
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="on_leave">On Leave</option>
                        </select>
        </div>

        <div class="form-group">
            <label for="role">Role*</label>
            <select id="role" name="role" required>
        <!-- Default option -->
        <option value="">Select role</option>

        <?php
        // Che$sql = "SELECT id, role_name FROM roles"; // assuming you have a 'roles' table with 'id' and 'role_name' columns
        $sql = "SELECT * FROM role";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // Loop through the results and create options
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['userrole'] . "'>" . $row['userrole'] . "</option>";
            }
        } else {
            echo "<option value=''>No roles available</option>";
        }
        ?>

    </select>
        </div>
    </div>
</div>

<!-- Bank Details -->
<div class="form-section">
    <h3>Bank Details</h3>
    <div class="form-grid">
        <div class="form-group">
            <label for="bank_ac_name">Account Holder Name*</label>
            <input type="text" id="bank_ac_name" name="bank_ac_name" value="" required>
        </div>
        <div class="form-group">
            <label for="bank_name">Bank Name*</label>
            <input type="text" id="bank_name" name="bank_name" value="" required>
        </div>
        <div class="form-group">
            <label for="bank_branch">Branch*</label>
            <input type="text" id="bank_branch" name="bank_branch" value="" required>
        </div>
        <div class="form-group">
            <label for="ifsc_code">IFSC Code*</label>
            <input type="text" id="ifsc_code" name="ifsc_code" value="" required>
        </div>
        <div class="form-group">
            <label for="bank_no">Account Number*</label>
            <input type="text" id="bank_no" name="bank_no" value="" required>
        </div>
    </div>
</div>

<!-- Login Details -->
<div class="form-section">
    <h3>Login Details</h3>
    <div class="form-grid">
        <div class="form-group">
            <label for="login_name">Username*</label>
            <input type="text" id="login_name" name="login_name" value="" required>
        </div>
        <div class="form-group">
            <label for="password">Password*</label>
            <input type="password" id="password" name="password" value="" required>
        </div>
    </div>
</div>
<button type="button" class="btn btn-danger" onclick ='employeeFormbutton()' >Add</button>
    </form>

    <div id="response"></div>
</div>

    


    <button class="theme-toggle" onclick="toggleTheme()">🌓</button>

    <script>
            function employeeFormbutton(){
        // Collect form data
      
        var name = $("#emp_name").val();
        var dob = $("#emp_dob").val();
        var gender = $("#gender").val();
        var marital_status = $("#marital_status").val();
        var email = $("#emp_email").val();
        var phone = $("#emp_phone").val();
        var alt_phone = $("#alternate_contact_phone").val();
        var address = $("#emp_address").val();
        var city = $("#emp_city").val();
        var pincode = $("#emp_pincode").val();
        var designation = $("#emp_designation").val();
        var department = $("#emp_dept").val();
        var joining_date = $("#emp_joining").val();
        var salary = $("#emp_salary").val();
        var incentive = $("#incentive").val();
        var center_id = $("#center_id").val();
        var status = $("#emp_status").val();
        var acc_name = $("#bank_ac_name").val();
        var bank_name = $("#bank_name").val();
        var branch = $("#bank_branch").val();
        var ifsc = $("#ifsc_code").val();
        var bank_no = $("#bank_no").val();
        var username = $("#login_name").val();
        var password = $("#password").val();
        var role = $('#role').val();
        var empcode = $('#empcode').val()
        // AJAX request
        $.ajax({
            url: "./backend/register_employee.php", // PHP script for form processing
            type: "POST",
            data: {
                
                emp_name: name,
                emp_dob: dob,
                emp_gender: gender,
                emp_marital_status: marital_status,
                emp_email: email,
                emp_phone: phone,
                emp_alt_phone: alt_phone,
                emp_address: address,
                emp_city: city,
                emp_pincode: pincode,
                emp_designation: designation,
                emp_department: department,
                emp_joining_date: joining_date,
                emp_salary: salary,
                emp_incentive: incentive,
                emp_center_id: center_id,
                emp_status: status,
                emp_acc_name: acc_name,
                emp_bank_name: bank_name,
                emp_branch: branch,
                emp_ifsc: ifsc,
                emp_bank_no: bank_no,
                emp_username: username,
                emp_password: password,
                role: role,
                empcode:empcode
            },
            success: function(response) {
            alert('Record Added')
            },
            error: function() {
                $("#responseMessage").html("There was an error processing the form.");
            }
        });
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
