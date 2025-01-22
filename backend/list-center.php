<?php 
include '../config/db.php';
function getCenter(){
    global $conn;
$sql = "SELECT * FROM `centre_master` ORDER BY centre_code DESC";
$stmt = $conn->query($sql);
$center = $stmt->fetch_all(MYSQLI_ASSOC);

$output = '';

if(count($center) > 0){
    $output .= '<div class="table-responsive">
                      <table class="table table-bordered table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Center Code</th>
                                <th>Center Name</th>
                                <th>Center Location</th>
                                <th>Edit</th>
                                

                            </tr>
                        </thead>
                        <tbody>';
                foreach($center as $row){
                    $output .= 
                    '<tr>
                        <td>' . $row['centre_code'] . '</td>
                        <td>' . $row['centre_name'] . '</td>
                        <td>' . $row['centre_location'] . '</td>
                        <td>
                            <button onclick="openEditModal(\'' . $row['centre_code'] . '\', \'' . $row['centre_name'] . '\', \'' . $row['centre_location'] . '\')" class="btn btn-sm btn-primary edit-center"
                                data-code="' . $row['centre_code'] . '"
                                data-name="' . $row['centre_name'] . '"
                                data-location="' . $row['centre_location'] . '">
                                <i class="fas fa-edit"></i> Edit
                            </button>
                        </td>
                    </tr>';
                
                
                }
                $output .= '</tbody></table></div>';
}else{
    $output .= '<p> No records </p>';
}
echo $output;
}
getCenter();