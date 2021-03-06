<?php
include_once '../User.php';
include_once '../helpers/DBConnector.php';
$db = new DBConnector;

try {
    /**
     * To retrieve users table
     */
    if (isset($_POST['get_users'])) {
        $user = User::create();
        $result = $user->readAll("user");
        $users = array();

        if ($result->num_rows > 0) {
            while ($user = $result->fetch_array()) {
                $users[] = $user;
            }
        }

        echo json_encode($users);
    }
} finally {
    $db->closeDatabase();
}
