<?php
session_start();
require_once './config/db.php';
include 'header.php'; // Include header only once
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Payment</title>
    <!-- Move these above header.php include -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./css/style1.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Your existing styles -->
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
.select2-container .select2-selection--single {
    height: 38px;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

.select2-container--default .select2-selection--single .select2-selection__arrow {
    height: 36px;
}.navbar-brand{
            padding:22px;
        }

    /* Add these new styles */
    .search-container {
        display: flex;
        align-items: flex-end;
        gap: 10px;
    }
    
    .search-wrapper {
        flex-grow: 1;
    }
    
    .search-btn {
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: 5px;
    }
    
    .search-icon {
        margin-right: 5px;
    }

    .container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 20px;
    }

    .page-title {
        display: block;
        text-align: center;
        font-size: 24px;
        margin-bottom: 30px;
        font-weight: bold;
    }

    .form-section {
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        margin-bottom: 30px;
        width: 100%;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    /* Remove the display:none since we're showing all sections */
    #additionalInfo {
        display: block;
    }

    /* Adjust table styles */
    .table {
        width: 100%;
        margin-bottom: 0;
    }

    .d-flex {
        display: flex !important;
    }

    .align-items-center {
        align-items: center !important;
    }

    .ml-2 {
        margin-left: 0.5rem !important;
    }

    #showDetailsBtn {
        white-space: nowrap;
        height: 38px;
    }

    #loanDetails {
        transition: all 0.3s ease-in-out;
    }
    </style>
</head>
<body>
    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
    
    <?php include('backbtn.php'); ?>

    <div class="main-content">
        <div class="container">
            <span class="page-title">Loan Details</span>
            
            <!-- Employee Information Section -->
            <div class="form-section">
                <h3>
                    Employee Information
                </h3>
                <div class="form-grid">
                    <div class="form-group position-relative">
                        <label for="emp_name">Employee*</label>
                        <div class="search-container">
                            <div class="search-wrapper">
                                <select id="emp_name" class="form-control select2" required>
                                    <option value="">Select Employee</option>
                                    <?php
                                    $sql = "SELECT * FROM employee_master";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['ename'] . "' data-empid='" . $row['empid'] . "'>" . $row['ename'] . "</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No Employee available</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <button class="btn btn-primary search-btn" type="button" id="searchBtn">
                                <i class="fas fa-search search-icon"></i> Search
                            </button>
                        </div>
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
                        <label for="emp_phone_no">Contact Number*</label>
                        <div class="d-flex align-items-center">
                            <input type="text" id="emp_phone_no" name="emp_phone_no" class="form-control" readonly>
                            <button type="button" class="btn btn-primary ml-2" id="showDetailsBtn">
                                <i class="fas fa-arrow-down"></i> Show Details
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sections to be toggled -->
            <div id="loanDetails" style="display: none;">
                <!-- Loan Payment Information Section -->
                <div class="form-section">
                    <h3>Loan Payment Information</h3>
                    <div class="form-grid">
                        <div class="form-group position-relative">
                            <label>Loan Amount </label>
                            <input type="hidden" id="loan_id">
                            <input type="hidden" id="loan_status">
                            <input type="number" id="loan_amount" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>EMI Amount</label>
                            <input type="number" id="emi_amount" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Payment Date*</label>
                            <input type="date" id="payment_date" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="loan_status">Loan Balance*</label>
                            <input type="text" id="loan_balance" name="loan_balance" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <button type="button" id="makePayment" class="btn btn-primary mt-4">Make Payment</button>
                        </div>
                    </div>
                </div>

                <!-- Payment History Section -->
                <div class="form-section">
                    <h3>Payment History</h3>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Employee Name</th>
                                <th>Paid Amount</th>
                                <th>Loan Balance</th>
                                <th>Payment Date</th>
                            </tr>
                        </thead>
                        <tbody id="payment_history">
                            <!-- Payment history will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Add this at the top of your scripts
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize the loan submenu state
            const currentPage = '<?php echo basename($_SERVER['PHP_SELF']); ?>';
            if (currentPage === 'loanad.php' || currentPage === 'loanpayment.php') {
                const loanSubmenu = document.getElementById('loanSubmenu');
                if (loanSubmenu) {
                    loanSubmenu.style.display = 'block';
                    const parentLink = document.querySelector('a[onclick*="loanSubmenu"]');
                    if (parentLink) {
                        parentLink.parentElement.classList.add('submenu-open');
                    }
                }
            }
            
            // Initialize Select2
            $('.select2').select2();
        });

        $(document).ready(function() {
            // alert("hello");

            let loan_amount = 0;

            // Initialize Select2
            $('.select2').select2({
                placeholder: "Search for an employee...",
                allowClear: true
            });
           

              // Function to calculate the balance amount
              function calculateBalance() {
                let emi = parseFloat($("#emi_amount").val()) || 0; // Ensure numeric input
                let loan_balance = loan_amount - emi; // Calculate balance
                $("#loan_balance").val(loan_balance.toFixed(2)); // Update the balance amount field
            }

            // Function to fetch loan details
            function getLoan() {
                let id = $("#emp_id").val();

                $.ajax({
                    url: "./backend/loan-data.php",
                    type: "POST",
                    dataType: "JSON",
                    data: { eid: id },
                    success: function (data) {
                        if (data.success === true) {
                            let loan_id = data.loan_id;
                            loan_amount = parseFloat(data.loan_bal_amount) || 0; // Update the global loan_amount
                            let emi_amount = data.emi_amount;
                            let loan_balance = data.loan_balance;
                            let loan_status = data.loan_status;

                            $("#loan_status").val(loan_status);
                            $("#loan_amount").val(loan_amount);
                            $("#loan_id").val(loan_id);

                            // alert(emi_amount);
                            $("#emi_amount").val(emi_amount);
                            $("#loan_balance").val(loan_balance);
                        } else if (data.success == false) {
                            alert(data.message);

                            loan_amount = data.loan_bal_amount;
                            let loan_id = data.loan_id;
                        
                            
                            $("#loan_amount").val(loan_amount);
                            $("#loan_id").val(loan_id);
                          
                        }
                        else {
                            alert("cant connect to the server");
                        }
                    }
                });
            }

            // Handle search button click
            $("#searchBtn").on("click", function() {

                let emp = $("#emp_name").val();
                // let empId = $("#emp_name option:selected").data("empid");

                $.ajax({
                    url: "./backend/emp-data.php",
                    type: "POST",
                    data: { empname: emp },
                    dataType : "json",
                    success: function(data) {
                        if (data.success = true) {

                            
                            let center = data.center;
                            let id = data.empid;
                            let designation = data.designation;
                            let dept = data.department;
                            let emp_phone_no = data.emp_phone_no;

                            $("#emp_id").val(id);
                            $("#emp_designation").val(designation);
                            $("#emp_dept").val(dept);
                            $("#center_id").val(center);
                            $("#emp_phone_no").val(emp_phone_no);

                            getLoan();

                            loan_history();
                        }
                        else{
                            alert(data.message);
                        }
                    }
                });
            });

            $('#emi_amount').on('input', calculateBalance);

            // Load payment history function
            function loan_history() {

                let employee_id = $("#emp_id").val();
                let employee_name = $('#emp_name').val();
                $.ajax({
                    url: './backend/loan-history.php',
                    type: 'POST',
                    
                    data: { emp_id: employee_id,
                        emp_name : employee_name
                     },
                    success: function(response) {
                        if(response){
                            alert("hello");
                            $("#payment_history").html(response);
                        }
                        else{
                            alert("please stand by we are busy");
                        }
                      
                    }
                });
            }

            // Make payment button click
            $('#makePayment').click(function() {
                const paymentData = {
                    emp_id: $('#emp_id').val(),
                    emi_amount : $('#emi_amount').val(),
                    loan_amount: $('#loan_amount').val(),
                    payment_date: $('#payment_date').val(),
                    current_balance: $('#loan_balance').val(),
                    loan_status : $('#loan_status').val(),
                    loan_id : $('#loan_id').val()
                };

                if (!paymentData.loan_amount || !paymentData.payment_date) {
                    alert('Please fill all required fields');
                    return;
                }

                $.ajax({
                    url: './backend/make_payment.php',
                    type: 'POST',
                    dataType: "json",
                    data: paymentData,
                    success: function(response) {
                        // const result = JSON.parse(response);
                        if (response.success) {
                            alert('Payment recorded successfully');
                            // $('#loan_balance').val(response.new_balance);
                            loan_history();


                            $('#loan_amount').val(' ');
                            $('#emi_amount').val(' ');
                            $('#payment_date').val(' ');
                            $('#loan_balance').val(' ');

                        } else {
                            alert('Error: ' + response.message);
                        }
                    }
                });
            });

            $('#showDetailsBtn').click(function() {
                const btn = $(this);
                const icon = btn.find('i');
                const loanDetails = $('#loanDetails');
                
                if (loanDetails.is(':hidden')) {
                    loanDetails.slideDown();
                    btn.html('<i class="fas fa-arrow-up"></i> Hide Details');
                } else {
                    loanDetails.slideUp();
                    btn.html('<i class="fas fa-arrow-down"></i> Show Details');
                }
            });

           
        });
    </script>
</body>
</html>