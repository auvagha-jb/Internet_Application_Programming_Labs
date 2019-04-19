<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();

    if (empty($_SESSION['username'])) {
        header("location: login.php");
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once 'helpers/css-js.php';?>
    <title>Private Page</title>
</head>

<body>
    <?php include_once 'helpers/nav-bar.php';?>

    <p>This is a private page</p>
    <p>We want to protect it</p>
</body>

</html>