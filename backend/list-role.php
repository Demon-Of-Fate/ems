<?php

include '../config/db.php';

function getRole() {
    global $conn;
    $sql = "SELECT * FROM `role` ORDER BY userid DESC";
    $stmt = $conn->query($sql);
    $role = $stmt->fetch_all(MYSQLI_ASSOC);

    $output = '';

    if (count($role) > 0) {
        $output .= '<div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Role ID</th>
                                <th>Role</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>';
        foreach ($role as $row) {
            // Sanitize user data to avoid any issues with special characters or HTML injection
            $userid = htmlspecialchars($row['userid']);
            $userrole = htmlspecialchars($row['userrole']);
           
            
            // Properly add the onclick event and ensure quotes are correctly escaped
            $output .= 
            '<tr>
                <td>' . $userid . '</td>
                <td>' . $userrole . '</td>
                <td> 
                    <button onclick="openEditModal(\'' . $userid . '\', \'' . $userrole . '\')" 
                            class="edit-btn btn btn-primary" 
                            data-id="' . $userid . '" 
                            data-role="' . $userrole . '">
                            Edit
                    </button>
                </td>
            </tr>';
        }
        $output .= '</tbody></table></div>';
    } else {
        $output .= '<p>No records found.</p>';
    }
    echo $output;
}

getRole();