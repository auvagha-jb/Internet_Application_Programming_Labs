<?php
if(session_status() == PHP_SESSION_NONE) session_start();

include_once '../helpers/DBconnector.php';
include_once '../helpers/ApiHandler.php';

$api_handler = new ApiHandler();

if($_SERVER['REQUEST_METHOD'] == "POST")
{
    $headers = apache_request_headers();
    $header_api_key = $headers['Authorization'];
    $api_handler->setUserApiKey($header_api_key);
    $api_key_correct = $api_handler->checkApiKey();
    $status = false;

    if($api_key_correct)
    {
        $order_data = [
            'order_name' => $_POST['order_name'],
            'units' => $_POST['units'],
            'unit_price' => $_POST['unit_price'],
            'order_status' => $_POST['order_status']
        ];
        $status = $api_handler->createOrder($order_data);
        
        print_r($status);
        $message = $status ? "Order has been placed" : "Something went wrong, please try again later"; 
    } else {
        $message = "Wrong API key";
    }

    echo json_encode(['status'=>$status, 'message'=>$message]);

} else if($_SERVER['REQUEST_METHOD'] == "GET"){
    //For retrieving
} else {
    //Not supported
}
