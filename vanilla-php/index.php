<?php
include_once './ApiGenerator.php';
$api = new ApiGenerator();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_id'])) {
    header("location: login.php");
}

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once 'helpers/css-js.php';?>
    <title>Order</title>
</head>

<body>
    <?php include_once 'helpers/nav-bar.php';?>
    <div id="user_id" class="d-none"><?=$_SESSION['user_id']?></div>
    <center id="page-feedback"></center>
    <h3>It is time to communicate with the API, all we need is the API key to be passed in the header</h3>
    <br>
    <div class="row">
        <div class="col s5 m5 l5">
            <h5>Feature 1 - placing an order</h5>
            <form action="model/Orders.php" method="post" id="order_form" class="pl-3">
                <legend class="lead">Place order</legend>
                <div class="input-field">
                    <input id="order_name" name="order_name" type="text" class="validate" required>
                    <label for="order_name">Name of food</label>
                    <span class="helper-text" data-error=""></span>
                </div>
                <div class="input-field">
                    <input id="units" name="units" type="text" class="validate">
                    <label for="units">Units</label>
                    <span class="helper-text" data-error=""></span>
                </div>
                <div class="input-field">
                    <input id="unit_price" name="unit_price" type="text" class="validate"><label for="unit_price">Unit
                        Price</label>
                    <span class="helper-text" data-error=""></span>
                </div>
                <input id="order_status" name="order_status" type="hidden" value="Order Placed" required>
                <input type="hidden" name="place_order" value="true">

                <button type="submit" name="btn-place-order" class="btn blue waves-effect waves-light submit-btn">Place
                    Order</button>
            </form>
        </div>
        <div class="col s7 m7 l7">
            <h5>Feature 2 - Check order status</h5>
            <form action="model/orders.php" method="POST" id="order_status_form" class="pl-3">
                <legend class="lead">Check order status</legend>
                <label for="orders">My orders</label>
                <select name="order_id" id="orders" class="form-control" required></select>

                <div id="order_status_check" class="alert alert-warning">Pick an order to check its status. The most
                    recent one appears at the top</div>
                <div class="alert alert-warning d-none" id="order_status_check"></div>
                <button type="submit" name="btn-check-status" class="btn blue waves-effect waves-light submit-btn">Check
                    status</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col s5 m5 l5">

        </div>
        <div class="col s5 m5 l5">
        </div>
    </div>
</body>

</html>