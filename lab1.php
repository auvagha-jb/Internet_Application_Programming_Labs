<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!--CSS Stylesheets-->
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="css/datatables.min.css">
    <link rel="stylesheet" href="css/materialize.css">
    <link rel="stylesheet" href="css/styles.css">
    <!--JS Scripts-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.js"></script>
    <script src="js/datatables.min.js"></script>
    <script src="js/main.js"></script>
    <title>Users</title>
</head>

<body class="users-page">
    <center class="alert alert-success fixed-top d-none"  id="page-feedback"></center>

    <!--Navigation bar-->
    <div class="navbar-fixed">
        <nav class="black">
            <div class="nav-wrapper">
                <a href="#!" class="brand-logo" id="brand-name" style="padding-left: 3%;">Labs</a>
                <!-- <ul class="right hide-on-med-and-down">
                    <li><a href="sass.html">Sass</a></li>
                    <li><a href="badges.html">Components</a></li>
                </ul> -->
            </div>
        </nav>
    </div>

    <div class="container">
        <div class="row">
            <!--Add users form-->
            <div class="col s12 l5" style="">
                <form method="post" action="model/Forms.php" id="add-user" class="white">
                    <p class="lead">Add user</>
                        <div class="input-field">
                            <input id="first_name" name="first_name" type="text" required>
                            <label for="first_name">First Name</label>
                        </div>
                        <div class="input-field">
                            <input id="last_name" name="last_name" type="text" required>
                            <label for="last_name">Last Name</label>
                        </div>
                        <div class="input-field">
                            <input id="city_name" name="city_name" type="text" required>
                            <label for="city_name">City</label>
                        </div>
                        <button type="submit" name="btn-save" class="btn blue waves-effect waves-light">Save</button>
                </form>
            </div>

            <!--Users table-->
            <div class="col s12 l6 offset-l1">
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
