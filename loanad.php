<?php
session_start();

// Regular page load - include other files
include 'header.php';
require_once './config/db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Advance Payment</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/style1.css">
    <style>
        /* Copy the styles from add_employee.php */
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .main-content {
            margin-left: 280px;
        }
        
        /* ... existing styles ... */

        /* Add form styling to match add_employee.php */
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
        
        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }.input-group {
    display: flex;
    width: 100%;
}

.input-group-append {
    display: flex;
    margin-left: -1px;
    margin-top: 5px;
}

.input-group .form-control {
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}

.input-group .btn {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
}

.btn-primary {
    color: #fff;
    background-color: var(--primary-color, #2c3e50);
    border-color: var(--primary-color, #2c3e50);
}

.btn-primary:hover {
    opacity: 0.9;
}.form-section {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.form-section h3 {
    color: var(--primary-color);
    margin-bottom: 20px;
}

.text-right {
    text-align: right;
}

.mt-4 {
    margin-top: 1.5rem;
}

input[type="number"]:read-only,
input[type="text"]:read-only {
    background-color: #f8f9fa;
    cursor: not-allowed;
}

.btn-primary {
    padding: 10px 20px;
    font-weight: 500;
}
    </style>
</head>
<body>
    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
        <?php include('header.php'); ?>
    

    <?php include('backbtn.php'); ?>

    <div class="main-content">
        <div class="container">
            <span>Loan Details</span>
            
            <!-- <form id="loanForm" class="employee-form"> -->
                <div class="form-section">
                    <h3>Employee Information</h3>
                    <div class="form-grid">
                    <div class="form-group position-relative">
    <!-- <label for="employee_search">Search Employee Name</label> -->
    <div class="input-group">
        <!-- <input type="text" class="form-control" id="employee_search" placeholder="Type employee name or ID..."> -->
        <label for="emp_designation">Employee*</label>
            
            <select name="" id="emp_name" required>
            <option value="">Select Employee</option>
            <?php
        // Che$sql = "SELECT id, role_name FROM employee master";
        $sql = "SELECT * FROM `employee_master`";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // Loop through the results and create options
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['ename'] . "'>" . $row['ename'] . "</option>";
            }
        } else {
            echo "<option value=''>No Employee available</option>";
        }
        ?>
        </select>
        <div class="input-group-append">
            <button class="btn btn-primary" type="button" id="searchBtn">
                Search
            </button>
        </div>
    </div>
    <div id="employeeList" class="employee-list"> </div>
</div>
                        
                        <div class="form-group">
    <label for="emp_id">Employee id*</label>
    <input type="text" id="emp_id" name="emp_id" class="form-control" readonly>
</div>

<div class="form-group">
    <label for="emp_designation">Designation*</label>
    <input type="text" id="emp_designation" name="emp_designation" class="form-control" readonly>
</div>

<div class="form-group">
    <label for="emp_dept">Department*</label>
    <input type="text" id="emp_dept" name="emp_dept" class="form-control" readonly>
</div>

<div class="form-group">
    <label for="center_id">Center ID</label>
    <input type="text" id="center_id" name="center_id" class="form-control" readonly>
</div>

<div class="form-group">
    <label for="emp_email">Email*</label>
    <input type="email" id="emp_email" name="emp_email" class="form-control" readonly>
</div>
                    </div>
                </div>

               
            <!-- </form> -->

                
        
    </div>
    <div class="form-section mt-4">
    <h3>Loan Details</h3>
    <div class="form-grid">
        <div class="form-group">
            <label for="loan_amount">Loan Amount*</label>
            <input type="number" id="loan_amount" name="loan_amount" class="form-control" required>
        </div>
        
     

        <!-- <div class="form-group">
            <label for="loan_status">Loan Status*</label>
            <input type="text" id="loan_status" name="loan_status" class="form-control" required>
        </div> -->

        <div class="form-group">
            <label for="loan_duration">Loan duration (in months)*</label>
            <input type="number" id="loan_duration" name="loan_duration" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="emi_amount">EMI Amount*</label>
            <input type="number" id="emi_amount" name="emi_amount" class="form-control" readonly>
        </div>

        <div class="form-group">
            <label for="start_date">Start Date*</label>
            <input type="date" id="start_date" name="start_date" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="loan_balance">Loan Balance Amount</label>
            <input type="number" id="loan_balance" name="loan_balance" class="form-control" readonly>
        </div>
    </div>

    <div class="text-right mt-4">
        <button type="submit" class="btn btn-primary" id="saveLoanBtn">Save Loan Details</button>
    </div>
</div>
</div>
    

    <!-- Keep existing JavaScript, but add theme toggle and sidebar functions -->
    <script>
        // ... existing JavaScript ...

        // Add these functions from add_employee.php
       

        
 $(document).ready(function(){
    // Cache jQuery selectors for better performance
    const $loanAmount = $('#loan_amount');
    const $numEmis = $('#num_of_emis');
    const $emiAmount = $('#emi_amount');
    const $loanBalance = $('#loan_balance');

    // // Calculate EMI amount function
    function calculateEMI() {
        const loanAmount = parseFloat($loanAmount.val()) || 0;
        const numEmis = parseInt($numEmis.val()) || 1;
        
         // Simple EMI calculation (loan amount divided by number of EMIs)
        const emiAmount = loanAmount / numEmis;
        $emiAmount.val(emiAmount.toFixed(2));
        $loanBalance.val(loanAmount.toFixed(2));
    }

     // Attach input event handlers using jQuery
    $loanAmount.on('input', calculateEMI);
    $numEmis.on('input', calculateEMI);
    

    //submit the name of employee
    $("#searchBtn").on("click", function(){
        // alert("he")
        let emp = $("#emp_name").val();
        
        $.ajax({
            url : "./backend/emp-data.php",
            type: "POST",
            // dataType:"JSON",
            data: {empname : emp},
            success: function(data){
                
                if(data.success == true){
                   let center = data.center;
                   let id = data.empid;
                   let designation = data.designation;
                   let dept =data.department;
                   let email = data.email;

                    $("#emp_id").val(id);
                    $("#emp_designation").val(designation);
                    $("#emp_dept").val(dept);
                    $("#center_id").val(center);
                    $("#emp_email").val(email);
                }
                
                else{
                    alert(data.message || "an error occured");
                }
            }
        });
    });




    // Handle form submission
    $('#saveLoanBtn').on('click', function(e) {
        
        
      
        let emp_id = $("#emp_id").val();
        let loanAmount = $("#loan_amount").val();
        let loan_status = $("#loan_status").val();
        let loan_duration = $("#loan_duration").val();
        let loan_bal_amount = $("#loan_balance").val();
        let start_date = $("#start_date").val();
        let emi = $("#num_of_emis").val();
        let emi_amount = $("#emi_amount").val();

        // alert("hello");

        $.ajax({
            url: "./backend/add-loan.php",
            type: "POST",
            datatype: "json",
            data: { 
                empid : emp_id,
                loan_amount :loanAmount,
                loan_status :loan_status,
                loan_duration :loan_duration,
                loan_bal_amount :loan_bal_amount,
                start_date :start_date,
                no_of_emi : emi,
                emi_amount :emi_amount
                
                
            },
            success: function(response) {
            if (response.success) {
                alert(response.message);
                // Optionally reset form or redirect

                //reset the input fields 
                $("#emp_id").val('');
                $("#emp_designation").val('');
                $("#emp_dept").val('');
                $("#center_id").val('');
                $("#emp_email").val('');
                $("#num_of_emis").val('');
                $("#loan_amount").val('');
                $("#loan_status").val('');
                $("#loan_duration").val('');
                $("#emi_amount").val('');
                $("#start_date").val('');
                $("#loan_balance").val('');
                
                // window.location.reload();
            } else {
                alert(response.message || "An error occurred");
            }
        },
        error: function(xhr, status, error) {
            console.error("AJAX Error:", status, error);
            alert("An error occurred while saving the loan details");
        }
            
        });
    });
});
    </script>
</body>
</html>
