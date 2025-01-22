<?php
session_start();
include './config/db.php';

// Redirect if not logged in
if ($_SESSION['logged_in'] == false) {
    header("Location: login.php");
}

$emp_phone_no = $conn->real_escape_string($_SESSION['emp_phone_no']);

// SQL Query
$sql = "SELECT * FROM employee_master";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/style1.css">

    <!-- Bootstrap Icons CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <style>
        table {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .menu-toggle {
            margin: 20px;
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

        /* Add the navbar styles from dashboard.php */
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
            display: flex;
            align-items: center;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding:25px;
        }

        .navbar-brand h3 {
            color: white;
            font-size: 1.5rem;
            margin: 0;
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
            margin-left: 250px;
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

        /* Table Styles */
        .table-responsive {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        #example {
            width: 100% !important;
            margin-bottom: 1rem;
            color: #212529;
        }

        #example thead th {
            background-color: var(--primary-color);
            color: white;
            border-bottom: none;
            padding: 12px 15px;
            font-weight: 500;
            text-transform: uppercase;
            font-size: 0.9rem;
            letter-spacing: 0.5px;
        }

        #example tbody td {
            padding: 12px 15px;
            vertical-align: middle;
            border-bottom: 1px solid #e9ecef;
            font-size: 0.9rem;
        }

        #example tbody tr:hover {
            background-color: #f8f9fa;
        }

        #example tbody tr:last-child td {
            border-bottom: none;
        }

        /* DataTables specific styling */
        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter {
            margin-bottom: 1rem;
        }

        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 4px 8px;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: var(--secondary-color);
            outline: none;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.25);
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5rem 1rem;
            margin: 0 2px;
            border-radius: 4px;
            border: none !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--secondary-color) !important;
            color: white !important;
            border: none !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #e9ecef !important;
            color: var(--primary-color) !important;
            border: none !important;
        }

        /* Action button styling */
        .btn-sm {
            padding: 0.25rem 0.5rem;
            font-size: 0.875rem;
            line-height: 1.5;
            border-radius: 0.2rem;
        }

        .btn-primary {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .btn-primary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        /* Add these styles to your existing style section */
        .page-header {
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
<?php  include('header.php');?>



<?php include('backbtn.php'); ?>
<?php if ($result->num_rows > 0) { ?>
    <!-- Main Content -->
    <div class="main-content">
        
        
        <?php if ($result->num_rows > 0) { ?>
            <div class="table-responsive">
                <table id="example" class="display table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Employee Name</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th>Joining Date</th>
                            <th>Date of Birth</th>
                            <th>Email</th>
                            <th>Phone No</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include './config/db.php';
                        $sql = "SELECT * FROM employee_master";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['ename']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['department']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['designation']) . "</td>";
                            echo "<td>" . date('d-m-Y', strtotime($row['emp_joining_date'])) . "</td>";
                            echo "<td>" . date('d-m-Y', strtotime($row['emp_dob'])) . "</td>";
                            echo "<td>" . htmlspecialchars($row['emp_email']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['emp_phone_no']) . "</td>";
                            echo "<td>
                                    <a href='EditProfile.php?id=" . $row['empid'] . "' class='btn btn-sm btn-primary'>
                                        <i class='bi bi-pencil-square'></i> view
                                    </a>
                                  </td>";
                            echo "</tr>";
                        }
                        mysqli_close($conn);
                     } ?>
                    </tbody>
                </table>
            </div>
        <?php } else { ?>
            <div class="alert alert-info" role="alert">
                <i class="bi bi-info-circle"></i> No data found.
            </div>
        <?php } ?>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css">
    <script src="https://cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>

    <script>
    $(document).ready(function () {
    // Initialize DataTable with column filter and disable search/sort for the last column
    var table = $('#example').DataTable({
        "pageLength": 10,
        "ordering": true,
        "searching": true,
        columnDefs: [
            {
                targets: -1, // Last column (Action column)
                searchable: false, // Disable search
                orderable: false, // Disable ordering
            },
        ],
    });

    // Add custom column filters
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

    // Add datetime display
    function updateDateTime() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('en-US', {
            hour: 'numeric',
            minute: '2-digit',
            hour12: true,
        });
        const dateString = now.toLocaleDateString('en-US', {
            day: 'numeric',
            month: 'long',
            year: 'numeric',
        });
        document.getElementById('datetime').textContent = `${timeString} - ${dateString}`;
    }

    updateDateTime();
    setInterval(updateDateTime, 1000);
});

// Theme toggle functionality
function toggleTheme() {
    const root = document.documentElement;
    const currentPrimary = getComputedStyle(root).getPropertyValue('--primary-color');

    const themes = {
        default: {
            primary: '#2c3e50',
            secondary: '#3498db',
            accent: '#e74c3c',
            background: '#f8f9fa',
        },
        dark: {
            primary: '#1a1a1a',
            secondary: '#2980b9',
            accent: '#c0392b',
            background: '#2c3e50',
        },
        light: {
            primary: '#3498db',
            secondary: '#2ecc71',
            accent: '#e67e22',
            background: '#ffffff',
        },
    };

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

    function toggleSidebar() {
        const navbar = document.querySelector('.navbar-container');
        navbar.classList.toggle('active');
    }
    </script>
</body>
</html>
