<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once '../ApiHandler.php';
$api_handler = new ApiHandler();

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['place_order'])) {

    $headers = apache_request_headers();
    $header_api_key = $headers['Authorization'];

    $api_handler->setUserApiKey($header_api_key);
    $api_key_correct = $api_handler->checkApiKey();
    $status = false;

    if ($api_key_correct) {
        $order_data = [
            'user_id' => $_SESSION['user_id'],
            'order_name' => $_POST['order_name'],
            'units' => $_POST['units'],
            'unit_price' => $_POST['unit_price'],
            'order_status' => $_POST['order_status'],
        ];
        $status = $api_handler->createOrder($order_data);
        $message = $status ? "Order has been placed" : "Something went wrong, please try again later";

    } else {
        $message = "Wrong API key";
    }

    echo json_encode(['status' => $status, 'message' => $message]);

} else if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['get_orders'])) {
    $result = $api_handler->fetchUserOrders($_SESSION['user_id']);
    $data = array();
    $data["num_rows"] = $result->num_rows;
    $data["orders_list"] = '<option value="">Pick and order here</option>';

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_array()) {
            $order_id = $row['order_id'];
            $name = $row['order_name'];
            $time = $row['time'];
            $data["orders_list"] .= '<option value="'.$order_id.'">Order no '.$order_id.': '.$name.'</option>';
        }
    }
    echo json_encode($data);

}else if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['get_order_status'])){
    $row = $api_handler->fetchOrderStatus($_POST['order_id']);
    $row['order_id'] = $_POST['order_id'];
    echo json_encode($row);

} else if ($_SERVER['REQUEST_METHOD'] == "GET") {
    //For retrieving
} else {
    //Not supported
}