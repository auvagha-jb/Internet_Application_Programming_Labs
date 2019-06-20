<?php
if(session_status() == PHP_SESSION_NONE) session_start();

include_once '../helpers/DBconnector.php';
include_once '../User.php';
include_once '../FileUploader.php';
include_once '../ApiGenerator.php';

$db = new DBConnector;
$uploader = new FileUploader;
$api = new ApiGenerator();
$conn = $db->conn;

// Create an instance of User class without params --> See method create()
$user = new User();

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
            $row = $user->getUserData($username);
            $user->setUserId($row['user_id']);
            $user->createUserSession();
        } else {
            header("location: ../login.php");
        }
    
    /**
     * Generate API Key
     */
    }elseif(isset($_POST['generate_api_key'])){
        if($_SERVER["REQUEST_METHOD"] !== "POST"){
            header("HTTP/1/0 403 Forbidden");
        } else { 
            $api->setApiKey($api->generateApiKey(64));
            header("Content-type: application/json");
            echo $api->generateResponse();
        }

    /**
     * Check whether user has API key 
     */
    } elseif(isset($_POST['has_api_key'])){

        $api_data = $api->fetchUserApiKey($_SESSION['user_id']);
        echo json_encode($api_data);
    }
    else {
        echo json_encode("Action not found");
    }

} catch (Exception $e) {
    echo json_encode(['status' => false, 'msg' => $e->getMessage]);

} finally {
    $db->closeDatabase();
}