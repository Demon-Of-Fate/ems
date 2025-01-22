<?php
session_start();
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
    <!-- Add these lines to your <head> section -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .input-group {
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
        }

        .form-section {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
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


                            <div class="form-group position-relative">
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


                <div class="form-section">
                    <h3>Loan Payment Information</h3>
                    <div class="form-grid">
                        <!-- <div class="form-group position-relative">
                            <label>Emi Id</label>
                            <input type="number" id="emi_id" class="form-control" readonly>
                        </div> -->
                        <!-- <div class="form-group">
            <label for="loan_status">Loan id*</label>
            <input type="text" id="loan_status" name="loan_status" class="form-control" required>
        </div> -->

                        <!--                         
<div class="form-group">
<label>EMI Amount</label>
<input type="number" id="emi_amount" class="form-control" readonly>
</div> -->


                        <div class="form-group">
                            <label>Loan Amount*</label>
                            <input type="number" id="loan_amount" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Payment Amount*</label>
                            <input type="number" id="payment_amount" class="form-control" required>
                        </div>
                        <div class="form-group">

                            <label>Balance Amount*</label>
                            <input type="hidden" id="loan_id">
                            <input type="number" id="bal_amount" class="form-control" readonly>
                        </div>

                        <div class="form-group">
                            <label>Payment Date*</label>
                            <input type="date" id="payment_date" class="form-control" required>
                        </div>
                        <!-- 
 <div class="form-group">
            <label for="loan_duration">Balance</label>
            <input type="number" id="loan_duration" name="loan_duration" class="form-control" required>
        </div> -->

                        <div class="form-group">
                            <button type="button" id="makePayment" class="btn btn-primary mt-4">Make Payment</button>
                        </div>
                    </div>


                </div>
            </div>
            <div class="payment-history">
                <h3>Payment History</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>EMI ID</th>

                            <th>Date Of Payment</th>
                            <th>EMI Amount</th>
                            <th>Loan Balance</th>
                        </tr>
                    </thead>
                    <tbody id="payment_history">


                        <!-- Payment history will be populated here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.select2').select2();

            // Declare loan_amount globally
            let loan_amount = 0;

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
                            $("#loan_amount").val(loan_amount);
                            $("#loan_id").val(loan_id);
                        } else if (data.success == false) {
                            alert(data.message);

                            loan_amount = data.loan_bal_amount;
                            let loan_id = data.loan_id;
                            $("#loan_amount").val(loan_amount);
                            $("#loan_id").val(loan_id);
                        }
                        else {
                            alert("cant connect to the server")
                        }
                    }
                });
            }

            // Function to calculate the balance amount
            function calculateBalance() {
                let payment = parseFloat($("#payment_amount").val()) || 0; // Ensure numeric input
                let bal_amount = loan_amount - payment; // Calculate balance
                $("#bal_amount").val(bal_amount); // Update the balance amount field
            }


            //function to fetch history of loan
            function loanHistory() {
                let id = $("#emp_id").val();

                $.ajax({
                    url: "./backend/loan-history.php",
                    type: "POST",
                    data: { empid: id },
                    success: function (data) {
                        if (data) {
                            // alert("hello");
                            $("#payment_history").html(data);
                        }
                        else {
                            alert("cant process the data");
                        }
                    }
                });

            }
            // When employee is selected
            $('#searchBtn').on("click", function () {
                let empName = $("#emp_name").val();

                // Fetch employee details
                $.ajax({
                    url: './backend/emp-data.php',
                    type: 'POST',
                    dataType: "JSON",
                    data: { empname: empName },
                    success: function (data) {
                        if (data.success === true) {
                            let center = data.center;
                            let id = data.empid;
                            let designation = data.designation;
                            let dept = data.department;
                            let email = data.email;

                            $("#emp_id").val(id);
                            $("#emp_designation").val(designation);
                            $("#emp_dept").val(dept);
                            $("#center_id").val(center);
                            $("#emp_email").val(email);

                            // Fetch loan details
                            getLoan();
                            loanHistory();
                        } else {
                            alert(data.message);
                        }
                    }
                });
            });


            // Load payment history function
            // function loadPaymentHistory(empId) {
            //     $.ajax({
            //         url: './backend/get_payment_history.php',
            //         type: 'POST',
            //         data: { emp_id: empId },
            //         success: function(response) {
            //             const payments = JSON.parse(response);
            //             let html = '';
            //             payments.forEach((payment, index) => {
            //                 html += `
            //                     <tr>
            //                         <td>${index + 1}</td>
            //                         <td>${payment.employee_id}</td>
            //                         <td>${payment.emi_amount}</td>
            //                         <td>${payment.loan_balance}</td>
            //                         <td>${payment.payment_date}</td>
            //                     </tr>
            //                 `;
            //             });
            //             $('#payment_history').html(html);
            //         }
            //     });
            // }

            // Make payment button click
            $('#makePayment').click(function () {
                const paymentData = {
                    emp_id: $('#emp_id').val(),
                    payment_amount: $('#payment_amount').val(),
                    payment_date: $('#payment_date').val(),
                    loan_amount: parseFloat($('#loan_amount').val()),
                    loan_bal: parseFloat($('#bal_amount').val()),
                    loan_id: $('#loan_id').val()
                };

                if (!paymentData.payment_amount || !paymentData.payment_date) {
                    alert('Please fill all required fields');
                    return;
                }

                $.ajax({
                    url: './backend/make_payment.php',
                    type: 'POST',
                    data: paymentData,
                    success: function (response) {
                    if (response.success == true) {
                        alert(response.message);
                        
                       
                        
                        // Reset loan payment fields
                        $('#loan_amount').val('');
                        $('#payment_amount').val('');
                        $('#bal_amount').val('');
                        $('#payment_date').val('');
                        $('#loan_id').val('');
                        
                        // Refresh payment history
                        loanHistory();
                        
                    } else if (response.success == false) {
                        alert(response.message);
                    } else {
                        alert('Error: ' + response.message);
                    }
                }
                });
            });
           

            // Trigger balance calculation when payment amount changes
            $('#payment_amount').on('input', calculateBalance);
        });

    </script>
</body>

</html>