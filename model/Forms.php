<?php
include_once '../helpers/DBconnector.php';
include_once '../User.php';
include '../FileUploader.php';

$db = new DBConnector;
$uploader = new FileUploader;
$conn = $db->conn;

// Create an instance of User class without params --> See method create()
$user = User::create();

try {
    /**
     * Check for duplicate usernames --> Used with Javascript validation
     */
    if (isset($_POST['user_exists'])) {
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
    } else {
        echo json_encode("Action not found");
    }

} catch (Exception $e) {
    echo json_encode(['status' => false, 'msg' => $e->getMessage]);

} finally {
    $db->closeDatabase();
}
