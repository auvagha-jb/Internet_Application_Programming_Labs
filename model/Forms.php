<?php
include_once '../helpers/DBconnector.php';
include_once '../User.php';

$db = new DBConnector;
$conn = $db->conn;

// Create an instance of User class without params --> See method create()
$user = User::create();

try {
    /**
     * Add user
     */
    if (isset($_POST['btn-save'])) {
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $city_name = $_POST['city_name'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = new User($first_name, $last_name, $city_name, $username, $password);

        /* Server side validation */
        //Ensures all fields are filled
        if (!$user->validateForm()) {
            $user->createFormErrorSessions("All fields are required");
            header("location: ../lab1.php");
            die();

            //Ensures there are no duplicate usernames
        } else if (!$user->usernameAvailable()) {
            $user->createFormErrorSessions("The username already exists");
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

    /**
     * Check for duplicate usernames --> Used with Javascript validation
     */
    elseif (isset($_POST['user_exists'])) {
        $available = $user->usernameAvailable();

        $data = array();
        $data['status'] = true;
        if (!$available) {
            $data['status'] = false;
            $data['msg'] = "Username already exists. Pick a different one.";
        }
        echo json_encode($data);
    }

    /**
     * Login
     */
    elseif (isset($_POST['btn-login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user->setUsername($username);
        $user->setPassword($password);

        if ($user->isPasswordCorrect()) {
            $user->login();
            $user->createUserSession();
        } else {
            header("location: ../login.php");
        }
    }

} finally {
    $db->closeDatabase();
}