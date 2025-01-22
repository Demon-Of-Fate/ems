<?php
session_start();
include './config/db.php';
if($_SESSION['logged_in'] == false){
   header("Location: login.php");
}


$eid = $conn->real_escape_string($_GET['id']);

// Construct the SQL query
$sql = "SELECT * FROM employee_master WHERE empid = '$eid'";
  // Change the condition as needed
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the data
    $employeeData = $result->fetch_assoc();
} else {
    echo "No data found.";
    exit;
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <style>


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
    background: white;
    padding: 25px;
    border-radius: 15px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
}

.form-section h3 {
    color: var(--primary-color);
    font-size: 1.2rem;
    font-weight: 600;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #f0f0f0;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 8px;
    font-size: 14px;
    color: #555;
    font-weight: 500;
}

.form-group input,
.form-group select,
.form-group textarea {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #e1e1e1;
    border-radius: 8px;
    font-size: 14px;
    transition: all 0.3s ease;
    background-color: #f8f9fa;
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    border-color: var(--secondary-color);
    box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.1);
    outline: none;
}

.form-group select {
    cursor: pointer;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='%23555' class='bi bi-chevron-down' viewBox='0 0 16 16'%3E%3Cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 12px center;
    padding-right: 35px;
}

.form-group textarea {
    resize: vertical;
    min-height: 100px;
}

/* Required Field Indicator */
.form-group label[for*="required"]::after,
.form-group label:has(+ input[required])::after,
.form-group label:has(+ select[required])::after {
    content: "*";
    color: var(--accent-color);
    margin-left: 4px;
}

/* Form Actions */
.form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 15px;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid #f0f0f0;
}

.form-actions button {
    padding: 10px 24px;
    border: none;
    border-radius: 8px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.3s ease;
}

.form-actions .btn-primary {
    background-color: var(--secondary-color);
    color: white;
}

.form-actions .btn-primary:hover {
    background-color: #2980b9;
    transform: translateY(-2px);
}

.form-actions .btn-secondary {
    background-color: #e9ecef;
    color: #495057;
}

.form-actions .btn-secondary:hover {
    background-color: #dee2e6;
}

/* Responsive Design */
@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }

    .container {
        padding: 15px;
    }

    .form-section {
        padding: 20px;
    }

    .form-actions {
        flex-direction: column;
    }

    .form-actions button {
        width: 100%;
    }
}

/* Error States */
.form-group input:invalid,
.form-group select:invalid {
    border-color: var(--accent-color);
}

.error-message {
    color: var(--accent-color);
    font-size: 12px;
    margin-top: 5px;
}

/* Success States */
.form-group.success input,
.form-group.success select {
    border-color: #2ecc71;
}

/* Disabled States */
.form-group input:disabled,
.form-group select:disabled,
.form-group textarea:disabled {
    background-color: #f8f9fa;
    cursor: not-allowed;
    opacity: 0.7;
}

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

.header-actions {
    display: flex;
    justify-content: flex-end;
    margin-bottom: 2rem;
}

.back-button {
    display: inline-flex;
    align-items: center;
    padding: 0.8rem 1.5rem;
    background-color: var(--secondary-color);
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    font-weight: 500;
}

.back-button:hover {
    background-color: #2980b9;
    transform: translateY(-2px);
    color: white;
    text-decoration: none;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}

.back-button i {
    margin-right: 0.5rem;
    font-size: 1.1rem;
}

    </style>
</head>
<body>
    <?php
    $eid = $conn->real_escape_string($_GET['id']);
    $sql = "SELECT * FROM employee_master WHERE empid = '$eid'"; // Change the condition as needed
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Fetch the data
        $employeeData = $result->fetch_assoc();
    } else {
        echo "No data found.";
        exit;
    } 
    ?>
    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
    <div style="background-color:#252729;width: 15%;">
        <div>
                <h3 style="padding-top: 17%;
    color: white;
    padding-bottom: 6%;    margin-left: 21%;">E M S</h3>
            </div>
            <hr style="color:white;">
<?php  include('header.php');?>


        </div>

    <div class="main-content">
    
    <div class="header-actions">
        <a href="dashboard.php" class="back-button">
            <i class="bi bi-arrow-left"></i> Back to Dashboard
        </a>
    </div>

    <div class="container">
    <span>Edit Employee  &nbsp;&nbsp;&nbsp;&nbsp;<?php echo htmlspecialchars($employeeData['ename']); ?></span>
    <?php
    if(isset($_POST['submit']))
    {
        $Phoneno = $_POST['Phoneno'];
        $id = $_POST['id'];
        $address = $_POST['address'];
        $pincode = $_POST['pincode'];
        $City = $_POST['City'];
        $AccouHolName = $_POST['AccouHolName'];
        $BankName = $_POST['BankName'];
        $BankBranch = $_POST['BankBranch'];
        $IFSC = $_POST['IFSC'];
        $Bankacc = $_POST['Bankacc'];
        
        // Check if the id is set
        if (!empty($id)) {
            // Sanitize the inputs (basic sanitization, consider more advanced methods for larger applications)
            $Phoneno = mysqli_real_escape_string($conn, $Phoneno);
            $address = mysqli_real_escape_string($conn, $address);
            $pincode = mysqli_real_escape_string($conn, $pincode);
            $City = mysqli_real_escape_string($conn, $City);
            $AccouHolName = mysqli_real_escape_string($conn, $AccouHolName);
            $BankName = mysqli_real_escape_string($conn, $BankName);
            $BankBranch = mysqli_real_escape_string($conn, $BankBranch);
            $IFSC = mysqli_real_escape_string($conn, $IFSC);
            $Bankacc = mysqli_real_escape_string($conn, $Bankacc);
        
            // Construct the SQL query
            $sql = "UPDATE employee_master SET 
                        emp_phone_no = '$Phoneno', 
                        emp_address = '$address', 
                        emp_pincode = '$pincode', 
                        emp_city = '$City', 
                        bank_account_name = '$AccouHolName', 
                        bank_name = '$BankName', 
                        bank_branch = '$BankBranch', 
                        ifsc_code = '$IFSC', 
                        bank_account_no = '$Bankacc'
                    WHERE empid = '$id'";
        
            // Execute the query
            if (mysqli_query($conn, $sql)) {
              
                echo  "Employee details updated successfully!";
            } else {
                echo "Error updating employee details: " . mysqli_error($con);
            }
    
        }
    }
  
    ?>
<?php 
if ($_SESSION['role'] == 'EMPLOYEE') {
?>
    <form id="employeeForm" class="employee-form" action="" method="post">
        <div class="form-section">
            <h3>Employee Info</h3>
            <?php if (isset($message)): ?>
                <div id="response"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>
            <div class="form-grid">
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($employeeData['empid']); ?>">
                <div class="form-group">
                    <label for="Phoneno">Phone No</label>
                    <input type="text" id="Phoneno" name="Phoneno" value="<?php echo htmlspecialchars($employeeData['emp_phone_no']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($employeeData['emp_address']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="pincode">Pincode</label>
                    <input type="text" id="pincode" name="pincode" value="<?php echo htmlspecialchars($employeeData['emp_pincode']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="City">City</label>
                    <input type="text" id="City" name="City" value="<?php echo htmlspecialchars($employeeData['emp_city']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="AccouHolName">Account Holder Name</label>
                    <input type="text" id="AccouHolName" name="AccouHolName" value="<?php echo htmlspecialchars($employeeData['bank_account_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="BankName">Bank Name</label>
                    <input type="text" id="BankName" name="BankName" value="<?php echo htmlspecialchars($employeeData['bank_name']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="BankBranch">Bank Branch</label>
                    <input type="text" id="BankBranch" name="BankBranch" value="<?php echo htmlspecialchars($employeeData['bank_branch']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="IFSC">IFSC</label>
                    <input type="text" id="IFSC" name="IFSC" value="<?php echo htmlspecialchars($employeeData['ifsc_code']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="Bankacc">Bank Account Number</label>
                    <input type="text" id="Bankacc" name="Bankacc" value="<?php echo htmlspecialchars($employeeData['bank_account_no']); ?>" required>
                </div>
            </div>
        </div>
        <button type="submit" name="submit" class="btn btn-danger">Edit</button>
    </form>
<?php
} else {
 ?>
 <button onclick ='enableEditing()' style="float:right;" class="btn btn-danger">Edit</button>
 <form id="employeeForm" class="employee-form" method="post">
 <?php if (isset($message)): ?>
                <div id="response1"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>
    <div class="form-section">
        <h3>Personal Information</h3>
        <div class="form-grid">
            <div class="form-group">
                <label for="emp_name">Full Name</label>
                <input type="text" id="emp_name" name="emp_name" value="<?php echo htmlspecialchars($employeeData['ename']); ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="emp_dob">Date of Birth</label>
                <input type="date" id="emp_dob" name="emp_dob" value="<?php echo htmlspecialchars($employeeData['emp_dob']); ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" name="gender" required disabled>
                    <option value="<?php echo htmlspecialchars($employeeData['emp_gender']); ?>"><?php echo htmlspecialchars($employeeData['emp_gender']); ?></option>
                    <option value="">Select gender</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="form-group">
                <label for="marital_status">Marital Status</label>
                <select id="marital_status" name="marital_status" disabled>
                    <option value="<?php echo htmlspecialchars($employeeData['marital_status']); ?>"><?php echo htmlspecialchars($employeeData['marital_status']); ?></option>
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
                <label for="emp_email">Email</label>
                <input type="email" id="emp_email" name="emp_email" value="<?php echo htmlspecialchars($employeeData['emp_email']); ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="emp_phone">Phone</label>
                <input type="tel" id="emp_phone" name="emp_phone" value="<?php echo htmlspecialchars($employeeData['emp_phone_no']); ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="alternate_contact_phone">Alternate Phone</label>
                <input type="tel" id="alternate_contact_phone" value="<?php echo htmlspecialchars($employeeData['emp_alt_contact_no']); ?>" name="alternate_contact_phone" readonly>
            </div>
            <div class="form-group">
                <label for="emp_address">Address</label>
                <textarea  id="emp_address" name ="emp_address" readonly><?php echo htmlspecialchars($employeeData['emp_address']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="emp_city">City</label>
                <input type="text" id="emp_city" name="emp_city" value="<?php echo htmlspecialchars($employeeData['emp_city']); ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="emp_pincode">Pincode</label>
                <input type="text" id="emp_pincode" name="emp_pincode" value="<?php echo htmlspecialchars($employeeData['emp_pincode']); ?>" required readonly>
            </div>
        </div>
    </div>

    <!-- Employment Details -->
    <div class="form-section">
        <h3>Employment Details</h3>
        <div class="form-grid">
            <div class="form-group">
                <label for="emp_designation">Designation</label>
                <select name="emp_designation" id="emp_designation" required disabled>
                    <option value="<?php echo htmlspecialchars($employeeData['designation']); ?>"><?php echo htmlspecialchars($employeeData['designation']); ?></option>
                    <?php
                    $sql = "SELECT * FROM designation";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
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
                <label for="empcode">Emp code</label>
                <input type="text" id="empcode" name="Emp_Code" value="<?php echo htmlspecialchars($employeeData['EmpCode']); ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="emp_dept">Department</label>
                <select name="emp_dept" id="emp_dept" required disabled>
                    <option value="<?php echo htmlspecialchars($employeeData['department']); ?>"><?php echo htmlspecialchars($employeeData['department']); ?></option>
                    <?php
                    $sql = "SELECT * FROM department";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
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
                <label for="emp_joining">Joining Date</label>
                <input type="date" id="emp_joining" name="emp_joining" value="<?php echo htmlspecialchars($employeeData['emp_joining_date']); ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="emp_salary">Salary</label>
                <input type="text" id="emp_salary" name="emp_salary" value="<?php echo htmlspecialchars($employeeData['emp_salary']); ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="incentive">Incentive</label>
                <select name="incentive" id="incentive" disabled>
                    <option value='<?php echo htmlspecialchars($employeeData['incentive']); ?>'><?php echo htmlspecialchars($employeeData['incentive']); ?></option>
                    <option value='yes'>Yes</option>
                    <option value='no'>No</option>
                </select>
            </div>
            <div class="form-group">
                <label for="center_id">Center ID</label>
                <select id="center_id" name="center_id" required disabled>
                    <option value="<?php echo htmlspecialchars($employeeData['centre_id']); ?>"><?php echo htmlspecialchars($employeeData['centre_id']); ?></option>
                    <?php foreach($center_master as $center): ?>
                        <option value="<?= $center['centre_code'] ?>"> <?= $center['centre_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group">
                <label for="emp_status">Status</label>
                <select id="emp_status" name="emp_status" required disabled>
                    <option value="<?php echo htmlspecialchars($employeeData['emp_status']); ?>"><?php echo htmlspecialchars($employeeData['emp_status']); ?></option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                    <option value="on_leave">On Leave</option>
                </select>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" required disabled>
                    <option value="<?php echo htmlspecialchars($employeeData['role']); ?>"><?php echo htmlspecialchars($employeeData['role']); ?></option>
                    <?php
                    $sql = "SELECT * FROM role";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
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
                <label for="bank_ac_name">Account Holder Name</label>
                <input type="text" id="bank_ac_name" name="bank_ac_name" value="<?php echo htmlspecialchars($employeeData['bank_account_name']); ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="bank_name">Bank Name</label>
                <input type="text" id="bank_name" name="bank_name" value="<?php echo htmlspecialchars($employeeData['bank_name']); ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="bank_branch">Branch</label>
                <input type="text" id="bank_branch" name="bank_branch" value="<?php echo htmlspecialchars($employeeData['bank_branch']); ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="ifsc_code">IFSC Code</label>
                <input type="text" id="ifsc_code" name="ifsc_code" value="<?php echo htmlspecialchars($employeeData['ifsc_code']); ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="bank_no">Account Number</label>
                <input type="text" id="bank_no" name="bank_no" value="<?php echo htmlspecialchars($employeeData['bank_account_no']); ?>" required readonly>
            </div>
            <input type="hidden" id="empid" name="empid" value="<?php echo htmlspecialchars($employeeData['empid']); ?>" required readonly>
        </div>
    </div>

    <!-- Login Details -->
    <div class="form-section">
        <h3>Login Details</h3>
        <div class="form-grid">
            <div class="form-group">
                <label for="login_name">Username</label>
                <input type="text" id="login_name" name="login_name" value="<?php echo htmlspecialchars($employeeData['login_name']); ?>" required readonly>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($employeeData['password']); ?>" required readonly>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-danger" name="submitform" onclick="getuserupdate()" id="submitbutton" disabled>Save</button>
</form>

    <?php   
}
?>


    <div id="response"></div>
</div>

    


    <button class="theme-toggle" onclick="toggleTheme()">🌓</button>

    <script>
  function enableEditing() {
        // Get all input and select elements inside the form
        var inputs = document.querySelectorAll("#employeeForm input, #employeeForm select, #employeeForm textarea");

        // Loop through all elements and remove the readonly and disabled attributes
        inputs.forEach(function(input) {
            input.removeAttribute('readonly');
            input.removeAttribute('disabled');
        });
        $('#submitbutton').prop('disabled', false);
      
    }
    
  window.onload = function() {
        const successMessage = document.getElementById('response');
        if (successMessage) {
            setTimeout(function() {
                successMessage.style.display = 'none';
            }, 3000);  // Hide the message after 3 seconds
        }
    };
  
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
        function getuserupdate() {
    // Collect values from form fields
    var emp_name = $('#emp_name').val();
    var emp_dob = $('#emp_dob').val();
    var gender = $('#gender').val();
    var marital_status = $('#marital_status').val();
    var emp_email = $('#emp_email').val();
    var emp_phone = $('#emp_phone').val();
    var alternate_contact_phone = $('#alternate_contact_phone').val();
    var emp_address = $('#emp_address').val();
    var emp_city = $('#emp_city').val();
    var emp_pincode = $('#emp_pincode').val();
    var emp_designation = $('#emp_designation').val();
    var empcode = $('#empcode').val();
    var emp_dept = $('#emp_dept').val();
    var emp_joining = $('#emp_joining').val();
    var emp_salary = $('#emp_salary').val();
    var incentive = $('#incentive').val();
    var center_id = $('#center_id').val();
    var emp_status = $('#emp_status').val();
    var role = $('#role').val();
    var bank_ac_name = $('#bank_ac_name').val();
    var bank_name = $('#bank_name').val();
    var bank_branch = $('#bank_branch').val();
    var ifsc_code = $('#ifsc_code').val();
    var bank_no = $('#bank_no').val();
    var login_name = $('#login_name').val();
    var password = $('#password').val(); // Corrected variable name to 'password'
    var empid = $('#empid').val(); // Corrected variable name to 'empid'

    // Prepare the data to be sent in the request
    var data = {
        emp_name: emp_name,
        emp_dob: emp_dob,
        gender: gender,
        marital_status: marital_status,
        emp_email: emp_email,
        emp_phone: emp_phone,
        alternate_contact_phone: alternate_contact_phone,
        emp_address: emp_address,
        emp_city: emp_city,
        emp_pincode: emp_pincode,
        emp_designation: emp_designation,
        empcode: empcode,
        emp_dept: emp_dept,
        emp_joining: emp_joining,
        emp_salary: emp_salary,
        incentive: incentive,
        center_id: center_id,
        emp_status: emp_status,
        role: role,
        bank_ac_name: bank_ac_name,
        bank_name: bank_name,
        bank_branch: bank_branch,
        ifsc_code: ifsc_code,
        bank_no: bank_no,
        login_name: login_name,
        password: password,
        empid: empid
    };

    // Perform the AJAX POST request
    $.ajax({
        url: 'upemp.php', // Replace with your server endpoint
        type: 'POST',
        data: data, // Data to send with the request
        success: function(response) {
           
            alert("User data updated successfully!");
            setTimeout(function() {
   location.reload();
}, 4000);
        },
        error: function(xhr, status, error) {
            // Handle any errors
            console.log("Error:", error);
            alert("There was an error updating the user data.");
        }
    });
}


        // Add logout functionality
       
    </script>
</body>
</html>
