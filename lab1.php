<?php session_start();?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--CSS Stylesheets-->
    <link rel="stylesheet" href="assets/materialize/materialize.css">
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.css">
    <link rel="stylesheet" href="assets/datatables/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <!--== JS Scripts ==-->
    <!-- Plugins -->
    <script src="assets/jquery/jquery.min.js"></script>
    <script src="assets/materialize/materialize.js"></script>
    <!-- DataTables -->
    <script src="assets/datatables/js/jquery.dataTables.min.js"></script>
    <script src="assets/datatables/js/dataTables.bootstrap4.js"></script>
    <script src="assets/bootstrap/bootstrap.min.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/validate.js"></script>
    <!-- Title -->
    <title>Users</title>
</head>

<body class="users-page">
    <center class="alert alert-success fixed-top d-none" id="page-feedback"></center>
    <!--Navigation bar-->
    <nav class="black">
        <div class="nav-wrapper">
            <a href="#!" class="brand-logo" id="brand-name" style="padding-left: 3%;">Labs</a>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <!--Add users form-->
            <div class="col s12 m12 l5" style="margin-top:10%;">
                <div class="form-errors">
                    <?php
if (!empty($_SESSION['form_errors'])) {
    echo $_SESSION['form_errors'];
    unset($_SESSION['form_errors']);
}
?>
                </div>
                <form method="post" action="model/Forms.php" id="add-user" name="user_details" class="white">
                    <p class="lead">Add user</p>
                    <div class="input-field">
                        <input id="first_name" name="first_name" type="text">
                        <label for="first_name">First Name</label>
                    </div>
                    <div class="input-field">
                        <input id="last_name" name="last_name" type="text">
                        <label for="last_name">Last Name</label>
                    </div>
                    <div class="input-field">
                        <input id="city_name" name="city_name" type="text">
                        <label for="city_name">City</label>
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