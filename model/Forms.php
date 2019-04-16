<?php
include_once '../DBconnector.php';
include_once '../User.php';

$db = new DBConnector;

try {
    /**
     * Add user form
     */
    if (isset($_POST['btn-save'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $city_name = $_POST['city_name'];
        $conn = $db->conn;

        $user = new User($first_name, $last_name, $city_name);
        $result = $user->save();

        $data = array();
        $data['msg'] = ($result) ? $first_name." ".$last_name." has been added"  : "Error: " . $conn->mysqli_error($conn);
        $data['status'] = $result;
        echo json_encode($data);
    }

    
} finally {
    $db->closeDatabase();
}
    
