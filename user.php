<?php
require './config/db.php';
require 'function.php';
// require './view/partial/header.php';
require './view/partial/nav.php';

//  if($_SESSION['logged_in'] == false){
//     header("Location: login.php");
//  }?>
<style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #2ecc71;
            --warning-color: #f1c40f;
            --background-color: #f8f9fa;
            --card-hover: #ecf0f1;
            --text-primary: #2c3e50;
            --text-secondary: #7f8c8d;
        }

        body {
            background-color: var(--background-color);
            color: var(--text-primary);
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
        }

        .card {
            border: none;
            transition: all 0.3s ease;
            border-radius: 15px;
            overflow: hidden;
        }

        .card:hover {
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
            transform: translateY(-2px);
        }

        .card-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            padding: 1.2rem !important;
        }

        .btn-custom {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            border: none;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-custom:hover {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(52, 152, 219, 0.3);
        }

        .form-control {
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead th {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 15px;
        }

        .table-hover tbody tr:hover {
            background-color: var(--card-hover);
            transform: scale(1.01);
            transition: all 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .table tbody tr {
            animation: fadeIn 0.5s ease-out forwards;
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--secondary-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-color);
        }
    </style>


<div class="container py-4">
        <div class="card shadow mb-4">
            <div class="card-header text-white d-flex align-items-center py-3">
                <a href="add_employee.php">Add Employee</a>
            </div>
           

        <div class="card shadow">
            <div class="card-header text-white d-flex align-items-center py-3">
                <h2 class="mb-0 fs-4">
                    <i class="fas fa-building me-2"></i>user List
                </h2>
            </div>
            <div class="card-body">
                <div id="table-responsive">
                   
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
    <script>
        $(document).ready(function(){

            //load table 
         loadData();
            

                function loadData() {
                    $.ajax({
                        url: "./backend/list-center.php",
                        type: "POST",
                        success: function(response) {
                            $("#table-responsive").html(response);
                        },
                        error: function(xhr, status, error) {
                            console.error("Error:", error);
                            $("#datatable").html("<p>Error loading data</p>");
                        }
                    });
                }
            // alert("page is loaded");
            $("#btn").on("click", function(e){
                e.preventDefault();
                // alert("you clicked");
                let centerCode = $("#centreCode").val();
                let centreName = $("#centreName").val();
                let centreLocation = $("#centreLocation").val();

                $.ajax({
                    url  : "./backend/add_center.php",
                    type : "POST",
                    data: {
                        centreCode :centerCode,
                        centreName : centreName,
                        centreLocation:centreLocation
                    },
                    success : function(response){
                        if(response.success){
                            $('#addCenter')[0].reset();
                            alert("center added");
                            loadData();
                        }
                        else if(!response.success){
                            alert(response.message);
                        }
                        else{
                            alert("something went wrong");
                        }

                    }
                });

            });

            // location.reload();

            
        });
    </script>




<?php require './view/partial/header.php'; ?>