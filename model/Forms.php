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

        //Server side validation
        if (!$user->validateForm()) {
            $user->createFormErrorSessions();
            header("location: ../lab1.php");
            die();
        }

        //Adds new user
        $result = $user->save();

        //Set the data to be returned to client
        $data = array();
        $data['msg'] = ($result) ? $first_name . " " . $last_name . " has been added" : "Error: " . $conn->mysqli_error($conn);
        $data['status'] = $result;
        echo json_encode($data);
    }

} finally {
    $db->closeDatabase();
}