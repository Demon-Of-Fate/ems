<?php
session_start();
require_once './config/db.php';
include 'header.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Advance Payment</title>
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

    .page-title {
        display: block;
        text-align: center;
        font-size: 24px;
        margin-bottom: 30px;
        font-weight: bold;
    }

    .table-responsive {
        overflow-x: auto;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
    }

    .table th,
    .table td {
        padding: 0.75rem;
        vertical-align: middle;
        border-top: 1px solid #dee2e6;
    }

    .table thead th {
        vertical-align: bottom;
        border-bottom: 2px solid #dee2e6;
        background-color: var(--primary-color, #2c3e50);
        color: white;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, 0.05);
    }@media screen and (max-width: 1024px) {
    .main-content {
        margin-left: 0;
        padding: 20px;
    }
    
    .container {
        padding: 15px;
    }
    
    .form-grid {
        grid-template-columns: 1fr 1fr; /* Keep 2 columns */
        gap: 15px;
    }
}

/* For tablets in portrait and larger phones */
@media screen and (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr; /* Switch to single column */
    }
    
    .form-section {
        padding: 20px;
    }
    
    .page-title {
        font-size: 20px;
        margin-bottom: 20px;
    }
    
    .search-container {
        flex-direction: column;
        gap: 5px;
    }
    
    .search-btn {
        width: 100%;
        margin-top: 10px;
    }
    
    .table-responsive {
        margin: 0 -15px;
    }
    
    .table th,
    .table td {
        padding: 0.5rem;
        font-size: 14px;
    }
}

/* For mobile phones */
@media screen and (max-width: 480px) {
    .container {
        padding: 10px;
    }
    
    .form-section {
        padding: 15px;
    }
    
    .page-title {
        font-size: 18px;
        margin-bottom: 15px;
    }
    
    .form-group label {
        font-size: 13px;
    }
    
    .form-group input,
    .form-group select {
        padding: 8px;
        font-size: 13px;
    }
    
    .btn {
        padding: 8px 16px;
        font-size: 14px;
    }
    
    .table th,
    .table td {
        padding: 0.4rem;
        font-size: 13px;
    }
    
    h3 {
        font-size: 18px;
    }
    
    .d-flex {
        flex-direction: column;
    }
    
    .ml-2 {
        margin-left: 0 !important;
        margin-top: 10px;
    }
    
    #showDetailsBtn {
        width: 100%;
    }
}

/* For very small devices */
@media screen and (max-width: 320px) {
    .container {
        padding: 5px;
    }
    
    .form-section {
        padding: 10px;
    }
    
    .page-title {
        font-size: 16px;
    }
    
    .table th,
    .table td {
        padding: 0.3rem;
        font-size: 12px;
    }
}

/* Add these styles for the back button */
.back-button {
    position: fixed;
    top: 20px;
    right: 20px; /* Changed from left to right */
    z-index: 1000;
    transition: all 0.3s ease;
}

/* Media queries for back button positioning */
@media screen and (max-width: 1024px) {
    .back-button {
        right: 20px; /* Keep consistent right spacing */
        top: 15px;
    }
}

@media screen and (max-width: 768px) {
    .back-button {
        right: 15px;
        top: 15px;
    }
    
    .back-button .btn {
        padding: 6px 12px;
        font-size: 14px;
    }
}

@media screen and (max-width: 480px) {
    .back-button {
        right: 10px;
        top: 10px;
    }
    
    .back-button .btn {
        padding: 5px 10px;
        font-size: 13px;
    }
}

@media screen and (max-width: 320px) {
    .back-button {
        right: 5px;
        top: 5px;
    }
    
    .back-button .btn {
        padding: 4px 8px;
        font-size: 12px;
    }
}
    </style>
</head>
<body>
    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
    
    <?php include('backbtn.php'); ?>

    <div class="main-content">
        <div class="container">
            <span class="page-title">New Loan</span>
            
            <!-- <form id="loanForm" class="employee-form"> -->
                <div class="form-section">
                    <h3>Employee Information</h3>
                    <div class="form-grid">
                        <div class="form-group position-relative">
                            <div class="search-container">
                                <div class="search-wrapper">
                                    <label for="emp_name">Employee*</label>
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
                            <label for="emp_designation">Designation*</label>
                            <input type="text" id="emp_designation" name="emp_designation" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="emp_id">Employee id*</label>
                            <input type="text" id="emp_id" name="emp_id" class="form-control" readonly>
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

               
            <!-- </form> -->

                
        
    </div>
    <div id="loanDetails" style="display: none;">
        <div class="form-section mt-4">
            <h3>Loan Details</h3>
            <div class="form-grid">
                <div class="form-group">
                    <label for="loan_amount">Loan Amount*</label>
                    <input type="number" id="loan_amount" name="loan_amount" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="num_of_emis">Number of EMIs*</label>
                    <input type="number" id="num_of_emis" name="num_of_emis" class="form-control" required>
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

    <!-- New Table Section -->
    <div class="form-section mt-4">
        <h3>Loan Records</h3>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Employee Name</th>
                        <th>Loan Amount</th>
                        <th>Number of EMIs</th>
                        <th>Total Amount Paid</th>
                        <th>Balance Amount</th>
                        <th>Start Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>EMP001</td>
                        <td>John Doe</td>
                        <td>50,000</td>
                        <td>12</td>
                        <td>20,000</td>
                        <td>30,000</td>
                        <td>2024-03-01</td>
                    </tr>
                    <tr>
                        <td>EMP002</td>
                        <td>Jane Smith</td>
                        <td>75,000</td>
                        <td>24</td>
                        <td>15,000</td>
                        <td>60,000</td>
                        <td>2024-02-15</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
    <button class="theme-toggle" onclick="toggleTheme()">🌓</button>

    <!-- Keep existing JavaScript, but add theme toggle and sidebar functions -->
     <script>
    $(document).ready(function() {
        // Initialize the loan submenu state on page load
        const currentPage = '<?php echo basename($_SERVER['PHP_SELF']); ?>';
        if (currentPage === 'loanad.php' || currentPage === 'loanpayment.php') {
            $('#loanSubmenu').show();
            $('a[onclick*="loanSubmenu"]').parent().addClass('submenu-open');
        }

        // Sidebar toggle function
        $('#sidebarToggleBtn').click(function() {
            $('.sidebar').toggleClass('active');
        });

        

        // Loan EMI calculation
        function calculateEMI() {
            const loanAmount = parseFloat($('#loan_amount').val()) || 0;
            const numEmis = parseInt($('#num_of_emis').val()) || 1;
            const emiAmount = loanAmount / numEmis;
            $('#emi_amount').val(emiAmount.toFixed(2));
            $('#loan_balance').val(loanAmount.toFixed(2));
        }

        // Listen for input changes and recalculate EMI
        $('#loan_amount, #num_of_emis').on('input', calculateEMI);

        
        // Handle employee search with AJAX
        $('#searchBtn').click(function() {
            const emp = $('#emp_name').val();

            $.ajax({
                url: './backend/emp-data.php',
                type: 'POST',
                data: { empname: emp },
                dataType: 'json',
                success: function(data) {
                    if (data.success) {
                        const { center, empid, designation, department, emp_phone_no } = data;
                        $('#emp_id').val(empid);
                        $('#emp_designation').val(designation);
                        $('#emp_dept').val(department);
                        $('#center_id').val(center);
                        $('#emp_phone_no').val(emp_phone_no);

                        
                        // loan_history(); // Assuming this function is defined elsewhere
                    } else {
                        alert(data.message);
                    }
                }
            });
        });


        // Handle loan form submission
        $('#saveLoanBtn').click(function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = {
                employee_id: $('#emp_id').val(),
                loan_amount: $('#loan_amount').val(),
                num_of_emis: $('#num_of_emis').val(),
                emi_amount: $('#emi_amount').val(),
                start_date: $('#start_date').val(),
                loan_balance: $('#loan_balance').val()
            };

            // Validate form data
            if (!formData.employee_id || !formData.loan_amount || !formData.num_of_emis || !formData.start_date) {
                alert('Please fill all required fields');
                return;
            }

            // Log form data (this is where you'd send data to your server)
            $.ajax({
                url: './backend/add-loan.php',
                type: 'POST',
                data: formData,
                dataType: 'json',
                success: function(data) {
                    if (data.success == true) {
                        alert(data.message)

                        
                        // loan_history(); // Assuming this function is defined elsewhere
                    } else {
                        alert(data.message);
                    }
                }
            });
        
        });

        // Handle showing and hiding loan details
        $('#showDetailsBtn').click(function() {
            const $btn = $(this);
            const $loanDetails = $('#loanDetails');

            $loanDetails.slideToggle(); // Toggles visibility of loan details
            if ($loanDetails.is(':visible')) {
                $btn.html('<i class="fas fa-arrow-up"></i> Hide Loan Details');
            } else {
                $btn.html('<i class="fas fa-arrow-down"></i> Show Loan Details');
            }
        });

        // Optional: Add theme toggle (light/dark mode)
        $('#themeToggleBtn').click(function() {
            $('body').toggleClass('dark-theme');
        });
    });
</script>
</body>
</html>
