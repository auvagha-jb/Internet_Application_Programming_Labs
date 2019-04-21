<?php
include 'User.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once 'helpers/css-js.php';?>
    <!-- Title -->
    <title>Users</title>
</head>

<body class="users-page">
    <center class="alert alert-success fixed-top d-none" id="page-feedback"></center>
    <?php include_once 'helpers/nav-bar.php';?>

    <div class="container">
        <div class="row">
            <!--Add users form-->
            <div class="col s12 m12 l5" style="margin-top:10%;">
                <div class="form-errors">
                    <?php User::show_form_error();?>
                </div>
                <form method="post" action="model/forms.php" id="add-user" name="user_details" class="white">
                    <p class="lead">Add user</p>
                    <div class="input-field">
                        <input id="first_name" name="first_name" type="text" class="validate">
                        <label for="first_name">First Name</label>
                        <span class="helper-text" data-error=""></span>
                    </div>
                    <div class="input-field">
                        <input id="last_name" name="last_name" type="text" class="validate">
                        <label for="last_name">Last Name</label>
                        <span class="helper-text" data-error=""></span>
                    </div>
                    <div class="input-field">
                        <input id="city_name" name="city_name" type="text" class="validate">
                        <label for="city_name">City</label>
                        <span class="helper-text" data-error=""></span>
                    </div>
                    <div class="input-field">
                        <input id="username" name="username" type="text" class="validate">
                        <label for="username">Username</label>
                        <span class="helper-text" data-error=""></span>
                    </div>
                    <div class="input-field">
                        <input id="password" name="password" type="password">
                        <label for="password">Password</label>
                        <span class="helper-text" data-error=""></span>
                    </div>
                    <button type="submit" name="btn-save"
                        class="btn blue waves-effect waves-light submit-btn">Save</button>
                </form>
            </div>

            <!--Users table-->
            <div class="col s12 m12 l6">
                <table id="users-table" class="table-striped table-hover">
                    <thead class="black text-white">
                        <tr>
                            <td>Name</td>
                            <td>City</td>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>
    </div>
</body>

</html>