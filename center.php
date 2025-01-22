<?php
// Database connection parameters
include './config/db.php';

session_start();
if ($_SESSION['logged_in'] == false) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Center Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/style1.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
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

        .sidebar {
            background: var(--primary-color);
            box-shadow: var(--card-shadow);
            border-radius: 0 15px 15px 0;
        }


        .nav-menu {
            padding: 1rem 0;
        }

        .nav-item {
            padding: 0.8rem 1.5rem;
            display: flex;
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
            margin-left: 300px;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        /* Theme toggle button */
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

        /* Mobile responsiveness */
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

        /* Back button styles */
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .back-btn:hover {
            background-color: var(--secondary-color);
            color: white;
            text-decoration: none;
            transform: translateX(-3px);
        }

        .back-btn i {
            font-size: 1.1rem;
        }.navbar-brand{
            padding:22px;
        }
    </style>
</head>
<body>
    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
    
        <?php  include('header.php');?>
        <?php include('backbtn.php'); ?>
    <!-- Remove the old sidebar div and replace with main-content div -->
    <div class="main-content">
        <!-- Existing container div -->
        <div class="container py-4">
            <!-- Add New Centre Card - Updated Design -->
            <div class="card shadow mb-4">
                <div class="card-header bg-gradient d-flex justify-content-between align-items-center py-3" 
                     style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
                    <h2 class="mb-0 fs-4 text-black">
                        <i class="fas fa-plus-circle me-2"></i>Add New Centre
                    </h2>
                </div>
                <div class="card-body p-4">
                    <form id="addCenter" action="" method="POST">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="centreCode" class="form-label fw-bold">
                                        <i class="fas fa-hashtag me-2"></i>Centre Code
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg shadow-sm" 
                                           id="centreCode" 
                                           name="centreCode" 
                                           placeholder="Enter centre code"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="centreName" class="form-label fw-bold">
                                        <i class="fas fa-building me-2"></i>Centre Name
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg shadow-sm" 
                                           id="centreName" 
                                           name="centreName" 
                                           placeholder="Enter centre name"
                                           required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="centreLocation" class="form-label fw-bold">
                                        <i class="fas fa-map-marker-alt me-2"></i>Centre Location
                                    </label>
                                    <input type="text" 
                                           class="form-control form-control-lg shadow-sm" 
                                           id="centreLocation" 
                                           name="centreLocation" 
                                           placeholder="Enter centre location"
                                           required>
                                </div>
                            </div>
                            <div class="col-12 mt-4">
                                <button type="submit" id="btn" class="btn btn-primary btn-lg px-5">
                                    <i class="fas fa-save me-2"></i>Save Centre
                                </button>
                                <button type="reset" class="btn btn-secondary btn-lg px-5 ms-2">
                                    <i class="fas fa-undo me-2"></i>Reset
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Centre List Card -->
            <div class="card shadow">
                <div class="card-header text-black d-flex align-items-center py-3">
                    <h2 class="mb-0 fs-4">
                        <i class="fas fa-building me-2"></i>Centre List
                    </h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Centre Code</th>
                                    <th>Centre Name</th>
                                    <th>Centre Location</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include './config/db.php';
                                $sql = "SELECT * FROM centre_master order by centre_code ASC";
                                $result = mysqli_query($conn, $sql);

                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row['centre_code']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['centre_name']) . "</td>";
                                    echo "<td>" . htmlspecialchars($row['centre_location']) . "</td>";
                                    echo "<td>
                                            <button class='btn btn-sm btn-primary' onclick='openEditModal(\"" . 
                                            htmlspecialchars($row['centre_code']) . "\", \"" . 
                                            htmlspecialchars($row['centre_name']) . "\", \"" . 
                                            htmlspecialchars($row['centre_location']) . "\")'>
                                                <i class='fas fa-edit'></i> Edit
                                            </button>
                                          </td>";
                                    echo "</tr>";
                                }
                                mysqli_close($conn);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Center Modal -->
        <div class="modal fade" id="editCenterModal" tabindex="-1" aria-labelledby="editCenterModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: white;">
                        <h5 class="modal-title" id="editCenterModalLabel">
                            <i class="fas fa-edit me-2"></i>Edit Centre
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editCenterForm">
                            <input type="hidden" id="editCenterId" name="centerId">
                            <div class="mb-3">
                                <label for="editCentreCode" class="form-label">Centre Code</label>
                                <input type="text" class="form-control" id="editCentreCode" name="centreCode" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="editCentreName" class="form-label">Centre Name</label>
                                <input type="text" class="form-control" id="editCentreName" name="centreName" required>
                            </div>
                            <div class="mb-3">
                                <label for="editCentreLocation" class="form-label">Centre Location</label>
                                <input type="text" class="form-control" id="editCentreLocation" name="centreLocation" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-custom" id="saveEditBtn">
                            <i class="fas fa-save me-2"></i>Save Changes
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Function to open the edit modal and populate it with current data
        function openEditModal(centreCode, centreName, centreLocation) {
            document.getElementById('editCentreCode').value = centreCode;
            document.getElementById('editCentreName').value = centreName;
            document.getElementById('editCentreLocation').value = centreLocation;
            

            var modal = new bootstrap.Modal(document.getElementById('editCenterModal'));
            modal.show();
        }

        $(document).ready(function() {
            // Function to handle saving edited center data
            $('#saveEditBtn').on('click', function() {
                const centerId = $('#editCenterId').val();
                const centreCode = $('#editCentreCode').val();
                const centreName = $('#editCentreName').val();
                const centreLocation = $('#editCentreLocation').val();

                $.ajax({
                    url: './backend/update_center.php',
                    type: "POST",
                    dataType: 'JSON',
                    data: {
                        centreCode: centreCode,
                        centreName: centreName,
                        centreLocation: centreLocation
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#editCenterModal').modal('hide');
                            alert('Center updated successfully');
                            loadData(); // Reload the table with updated data
                        } else {
                            alert(response.message || 'Error updating center');
                        }
                    },
                    error: function() {
                        alert('Error  center');
                    }
                });
            });

            // Handle new center addition
            $('#btn').on("click", function(e) {
                e.preventDefault();

                let centerCode = $("#centreCode").val();
                let centreName = $("#centreName").val();
                let centreLocation = $("#centreLocation").val();

                $.ajax({
                    url: "./backend/add_center.php",
                    type: "POST",
                    data: {
                        centreCode: centerCode,
                        centreName: centreName,
                        centreLocation: centreLocation
                    },
                    success: function(response) {
                        if (response.success) {
                            $('#addCenter')[0].reset();
                            alert("Center added successfully");
                            loadData();
                        } else {
                            alert(response.message || 'Something went wrong');
                        }
                    },
                    error: function() {
                        alert('Error adding center');
                    }
                });
            });

            // Function to load data (centers) into the table
            function loadData() {
                $.ajax({
                    url: "./backend/list-center.php",
                    type: "POST",
                    success: function(response) {
                        $("#table-responsive").html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                        $("#table-responsive").html("<p>Error loading data</p>");
                    }
                });
            }

            loadData(); // Initially load data
        });
    </script>
    <!-- Add DataTables CSS and JS before your existing scripts -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>

    <!-- Initialize DataTable with the same options as employee.php -->
    <script>
    $(document).ready(function () {
        var table = $('#example').DataTable({
            "pageLength": 10,
            "ordering": true,
            "searching": true,
            columnDefs: [
                {
                    targets: -1, // Last column (Action column)
                    searchable: false,
                    orderable: false,
                },
            ],
        });

        // Add column filters
        $('#example thead tr').clone(true).appendTo('#example thead');
        $('#example thead tr:eq(1) th').each(function (i) {
            var title = $(this).text();
            if (i !== table.columns().nodes().length - 1) { // Skip the last column
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
                $('input', this).on('keyup change', function () {
                    table.column(i).search(this.value).draw();
                });
            } else {
                $(this).empty(); // Remove input box for the Action column
            }
        });
    });
    </script>
</body>
</html>
