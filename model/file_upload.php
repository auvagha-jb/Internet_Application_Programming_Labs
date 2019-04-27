<?php
include_once '../helpers/DBconnector.php';
include_once '../User.php';
include '../FileUploader.php';

$db = new DBConnector;
$uploader = new FileUploader;
$conn = $db->conn;

// Create an instance of User class without params --> See method create()
$user = User::create();

// $status = $uploader->uploadFile();
// $msg = $uploader->getMsg();
// $data = array('path' => $uploader->getPath(), 'status' => $status, 'target' => 'file', 'msg' => $msg, 'size' => $uploader->getFileSize(), 'type' => $uploader->getFileType());
// echo json_encode($data);

try {
    /**
 * Add user
 */
if (isset($_POST['first_name']) && isset($_POST['last_name'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $city_name = $_POST['city_name'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $user = new User($first_name, $last_name, $city_name, $username, $password);
    $upload_status = $uploader->uploadFile();
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

        //If the file isn't uploaded...
    } else if (!$upload_status) {
        $msg = $uploader->getMsg();
        $data = array('status' => $upload_status, 'target' => 'file', 'msg' => $msg, 'size' => $uploader->getFileSize(), 'type' => $uploader->getFileType());
        echo json_encode($data);

    } else {

        $conn->autocommit(false);
        //Insert --> Adds new user
        $user->save();
        //Update --> Adds the path to the uploaded file
        $uploader->updateImage($username);

        $saved = $conn->commit();

        //Set the data to be returned to client
        $msg = ($saved) ? $first_name . " " . $last_name . " has been added" : "Error: " . $conn->mysqli_error($conn);
        $target = 'add-user';

        $response = array(
            'msg' => $msg,
            'target' => $target,
            'status' => $saved,
            'name' => $uploader->getOriginalName(),
        );

        echo json_encode($response);

    }
} else {
    echo json_encode("File data not received");
}

} catch(Exception $e) {
    echo json_encode(['status'=>false, 'msg'=>$e->getMessage]);

} finally {
    $db->closeDatabase();
}