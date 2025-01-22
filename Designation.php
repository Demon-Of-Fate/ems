<?php
session_start();
include './config/db.php';
if($_SESSION['logged_in'] == false){
   header("Location: login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style1.css">
    <style>
        /* Add root variables */
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --background-color: #f8f9fa;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .vertical-list {
        list-style: none;
        padding: 0;
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        gap: 10px;
    }

    .vertical-list li {
        border: 1px solid #ccc;
        padding: 10px;
        border-radius: 5px;
        width: fit-content;
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

        /* Add these improved table styles */
        .designation-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            margin-top: 20px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .designation-table thead {
            background-color: #f8f9fa;
        }

        .designation-table th {
            background-color: #2c3e50;
            color: white;
            padding: 12px 15px;
            text-align: left;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .designation-table tbody tr:nth-child(even) {
            background-color: #f4f4f4;
        }

        .designation-table tbody tr:hover {
            background-color: #e9ecef;
        }

        .designation-table td {
            padding: 10px 15px;
            border-bottom: 1px solid #dee2e6;
        }

        .designation-table .action-btn {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .designation-table .action-btn:hover {
            background-color: #2980b9;
        }

        /* Add back button styles */
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
            margin-bottom: 20px;
        }

        .back-btn:hover {
            background-color: var(--secondary-color);
            color: white;
            text-decoration: none;
            transform: translateX(-3px);
        }

        /* Add these new navbar styles */
        .navbar-container {
            position: fixed;
            left: 0;
            top: 0;
            background: var(--primary-color);
            color: white;
            transition: all 0.3s ease;
            z-index: 1000;
            box-shadow: var(--card-shadow);
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

        .main-content {
            margin-left: 280px;
            padding: 2rem;
            transition: all 0.3s ease;
        }.navbar-brand{
            padding:22px;
        }
    </style>
</head>
<body>
    <button class="menu-toggle" onclick="toggleSidebar()">☰</button>
    
<?php  include('header.php');?>


    
   
<?php include('backbtn.php'); ?>
    <div class="main-content">
    <!-- Replace the existing back button with this new version -->
    

    <!-- Updated card with white background and black text -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-white">
            <h4 class="mb-0 text-dark">Add Designation</h4>
        </div>
        <div class="card-body">
            <p id="response"></p>
            <form>
                <div class="form-group">
                    <label for="Designation">Designation</label>
                    <input type="text" class="form-control" id="Designation" style="width: 100%;" aria-describedby="emailHelp" placeholder="Enter Designation">
                </div>
                <button type="button" onclick="addDesignation()" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Details</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="modalBody">
        
          <input type="text" id="desid" class="form-control" readonly ><br>
          <input type="text" id="designation" class="form-control">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="update()">update</button>
        </div>
      </div>
    </div>
  </div>

    <!-- Replace the existing table with this improved version -->
    <div class="table-responsive">
        <table id="example" class="display designation-table">
            <thead>
                <tr>
                    <th class="id-column">Desig ID</th>
                    <th class="designation-column">Designation</th>
                    <th class="action-column">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM designation ORDER BY desigid DESC";
                $result = $conn->query($sql);
                
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) { 
                ?>
                <tr>
                    <td class="id-column"><?php echo $row['desigid'] ?></td>
                    <td class="designation-column"><?php echo $row['designation'] ?></td>
                    <td class="action-column">
                        <button 
                            class="action-btn" 
                            onclick="getdetails('<?php echo $row['desigid'] ?>','<?php echo $row['designation'] ?>')">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                    </td>
                </tr>
                <?php
                    }
                } 
                ?>
            </tbody>
        </table>
    </div>

    <!-- Add DataTables initialization script -->
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
                    targets: -1,
                    searchable: false,
                    orderable: false,
                },
            ],
        });

        // Add custom column filters
        $('#example thead tr').clone(true).appendTo('#example thead');
        $('#example thead tr:eq(1) th').each(function (i) {
            var title = $(this).text();
            if (i !== table.columns().nodes().length - 1) {
                $(this).html('<input type="text" placeholder="Search ' + title + '" />');
                $('input', this).on('keyup change', function () {
                    table.column(i).search(this.value).draw();
                });
            } else {
                $(this).empty();
            }
        });
    });
    </script>

    <button class="theme-toggle" onclick="toggleTheme()">🌓</button>

    <script>
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
        function addDesignation() {
    var desgn = $('#Designation').val(); 
    if (desgn != '') {
        
        $.ajax({
            url: 'add_Master.php', 
            type: 'POST',
            dataType: 'json', 
            data: { designation: desgn },
            success: function(response) {
               
                if (response.status === 'success') {
                        $('#response').text('Data Added Succesfuly');
                        setTimeout(function(){
location.reload();
                        },2000);
                    } else {
                        $('#response').html('<p>Error: ' + response.message + '</p>');
                    }

                // Optionally, you can update the UI here
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur during the request
                alert('There was an error adding the designation!');
            }
        });
    } else {
        alert('Please enter a designation.');
    }
}
function getdetails(id, designation) {
      $('#desid').val(id)
      $('#designation').val(designation)
      $('#myModal').modal('show');
    }
    function update() {
      // Get values from the form
      var id = $('#desid').val();
      var designation = $('#designation').val();

      // AJAX POST request
      $.ajax({
        url: 'add_Master.php', // Replace with your server endpoint URL
        type: 'POST',
        dataType: 'json',
        data: {
          id: id,
          desi: designation
        },
        success: function(response) {
            if (response.status === 'updated') {
                        $('#response').text('Data updated Succesfuly');
                        setTimeout(function(){
location.reload();
                        },2000);
                    } else {
                        $('#response').html('<p>Error: ' + response.message + '</p>');
                    }// You can log or display the response
        },
        error: function(xhr, status, error) {
          // Handle error (in case of failure)
          alert('Error: ' + error);
        }
      });
    } // Add logout functionality
       
    </script>
</body>
</html>
