<?php
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
    <title>User Management</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style1.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

        .form-control, .form-select {
            border-radius: 8px;
            border: 2px solid #e2e8f0;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .table {
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead th {
            color: black;
            border: none;
            padding: 15px;
        }

        .table-hover tbody tr:hover {
            background-color: var(--card-hover);
            transform: scale(1.01);
            transition: all 0.3s ease;
        }

        .badge {
            padding: 8px 12px;
            border-radius: 6px;
            font-weight: 500;
        }

        .btn-sm {
            padding: 5px 10px;
            border-radius: 6px;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            border: none;
        }

        .btn-danger {
            background-color: var(--accent-color);
            border: none;
        }

        .alert {
            border-radius: 10px;
            border: none;
            padding: 15px 20px;
            margin-bottom: 20px;
        }

        .modal-content {
            border-radius: 15px;
            border: none;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 15px 15px 0 0;
        }

        .form-label {
            font-weight: 500;
            color: var(--text-primary);
            margin-bottom: 8px;
        }

        /* Custom animation for table rows */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .table tbody tr {
            animation: fadeIn 0.5s ease-out forwards;
        }

        /* Loading spinner */
        .spinner-border {
            color: var(--secondary-color);
        }

        /* Custom scrollbar */
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
.navbar-brand{
            padding:22px;
        }
    </style>
</head>
<body>
<button class="menu-toggle" onclick="toggleSidebar()">☰</button>
            <?php  include('header.php');?>


        
            <?php include('backbtn.php'); ?>
<div class="col-sm-2">
    </div>
    <div class="col-sm-10">
    <div class="container py-4" style="margin-left: 8%;">
      
        <div class="modal fade" id="editCenterModal" tabindex="-1" aria-labelledby="editCenterModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: white;">
                        <h5 class="modal-title" id="editCenterModalLabel">
                            <i class="fas fa-edit me-2"></i>Edit Role
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editroleForm">
                            <div class="mb-3">
                                <label for="edit_roleid" class="form-label">Role ID</label>
                                <input type="text" class="form-control" id="edit_roleid" name="roleid" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="edit_rolename" class="form-label">Role Name</label>
                                <input type="text" class="form-control" id="edit_rolename" name="rolename" required>
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
        <!-- Success/Error Messages -->
        <div id="alertContainer"></div>

        <!-- Add New Role Card - Updated Design -->
        <div class="card shadow mb-4">
            <div class="card-header bg-gradient d-flex justify-content-between align-items-center py-3" 
                 style="background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));">
                <h2 class="mb-0 fs-4 text-black">
                    <i class="fas fa-plus-circle me-2"></i>Add New Role
                </h2>
            </div>
            <div class="card-body p-4">
                <form id="addRoleForm" class="needs-validation" novalidate>
                    <input type="hidden" name="action" value="add">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="add_rolename" class="form-label fw-bold">
                                    <i class="fas fa-user-tag me-2"></i>Role Name
                                </label>
                                <input type="text" 
                                       class="form-control form-control-lg shadow-sm" 
                                       id="add_rolename" 
                                       name="rolename" 
                                       placeholder="Enter role name"
                                       required>
                            </div>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="fas fa-save me-2"></i>Save Role
                            </button>
                            <button type="reset" class="btn btn-secondary btn-lg px-5 ms-2">
                                <i class="fas fa-undo me-2"></i>Reset
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Role List Card -->
        <div class="card shadow">
            <div class="card-header text-black d-flex align-items-center py-3">
                <h2 class="mb-0 fs-4">
                    <i class="fas fa-users me-2"></i>Role List
                </h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Role ID</th>
                                <th>Role Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include './config/db.php';
                            $sql = "SELECT * FROM role order by userid asc";
                            $result = mysqli_query($conn, $sql);

                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['userid']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['userrole']) . "</td>";
                                echo "<td>
                                        <button class='btn btn-sm btn-primary' onclick='openEditModal(\"" . 
                                        htmlspecialchars($row['userid']) . "\", \"" . 
                                        htmlspecialchars($row['userrole']) . "\")'>
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
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function openEditModal(roleid, rolename) {
            document.getElementById('edit_roleid').value = roleid;
            document.getElementById('edit_rolename').value = rolename;

            var modal = new bootstrap.Modal(document.getElementById('editCenterModal'));
            modal.show();
        }

        // Function to handle saving edited role data
        $('#saveEditBtn').on('click', function() {
            const Roleid = $('#edit_roleid').val();
            const Rolename = $('#edit_rolename').val();

            $.ajax({
                url: './backend/update_role.php',
                type: "POST",
                dataType: 'JSON',
                data: {
                    roleid: Roleid,
                    rolename: Rolename
                },
                success: function(response) {
                    if (response.success) {
                        $('#editCenterModal').modal('hide');
                        alert('Role updated successfully');
                        loadUsers(); // Reload the table with updated data
                    } else {
                        alert(response.message || 'Error updating role');
                    }
                },
                error: function() {
                    alert('Error updating role');
                }
            });
        });

        // Function to load users
        function loadUsers() {
            $.ajax({
                url: "./backend/list-role.php",
                type: "POST",
                success: function(response) {
                    $("#userListContainer").html(response);
                }
            });
        }

        $(document).ready(function() {
            loadUsers();
        });

        // Form submission with auto-refresh
        $('#addRoleForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: './backend/user1.php',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        $('#addRoleForm')[0].reset();
                        alert("Role added successfully");
                        loadUsers();  // Refresh immediately after success
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Error occurred while adding role');
                }
            });
        });
    </script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>

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
