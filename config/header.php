<?php 
$role = isset($_SESSION['role']) ? $_SESSION['role'] : '';

echo '<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">';

?>
<ul class="sidebar-menu">
    <?php if($role == 'ADMIN'){
?>

 <li><a href="dashboard.php">Dashboard</a></li>
 <li><a href="employee.php">Employee</a></li>
 <li><a href="add_employee.php">Add Employee</a></li>
<li><a href="center.php">Center</a></li>
<li><a href="role.php">Role</a></li>
<li><a href="Designation.php">Designation</a></li>
<li><a href="Department.php">Department</a></li>
<li><a href="logout.php">Logout</a></li>
<?php
    }
    else if($role == 'HR - ADMIN')
    {
        ?>
        <li><a href="dashboard.php"><i class="bi bi-person-circle"></i>Profile</a></li>
        <li><a href="employee.php"><i class="bi bi-people"></i>View Employee</a></li>
        <li><a href="add_employee.php"><i class="bi bi-person-plus"></i>Add Employee</a></li>
        <li><a href="report.php"><i class="bi bi-file-earmark-text"></i>Report</a></li>
        <li><a href="logout.php"><i class="bi bi-box-arrow-right"></i>Logout</a></li>
        <?php 
    }else if($role =='EMPLOYEE') {?>

    <li><a href="dashboard.php">Profile</a></li>
    <li><a href="dashboard.php">Attendence</a></li>
    <li><a href="dashboard.php">Salary</a></li>
    <li><a href="dashboard.php">Report</a></li>
    <li><a href="logout.php">Logout</a></li>
    <?php }else if($role =='ACCOUNTS - ADMIN') {?>
        <li><a href="employee.php">Employee Details</a></li>
    <li><a href="dashboard.php">Emp Attendence</a></li>
    <li><a href="dashboard.php">Emp Salary</a></li>
    <li><a href="dashboard.php">Emp Report</a></li>
    <li><a href="logout.php">Logout</a></li>
    <?php }?>
</ul>
