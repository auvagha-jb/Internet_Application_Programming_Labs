<?php
session_start();
include_once 'User.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once 'helpers/css-js.php';?>
    <title>Login</title>
</head>

<body>
    <?php include_once 'helpers/nav-bar.php';?>
    <form action="model/forms.php" method="post" class="sign-in">
        <div class="form-errors">
            <?php User::show_form_error();?>
        </div>
        <p class="lead text-white">Welcome back!</p>
        <div class="input-field">
            <input id="username" name="username" type="text" class="text-white" required>
            <label for="username">Username</label>
        </div>
        <div class="input-field">
            <input id="password" name="password" type="password" class="text-white" required>
            <label for="password">Password</label>
        </div>
        <button class="btn black login-btn waves-effect waves-light submit-btn" name="btn-login">Login</button>
    </form>
</body>

</html>