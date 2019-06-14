<?php
include_once './ApiGenerator.php';
$api = new ApiGenerator();

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
    <center id="page-feedback" class="alert"></center>
    <h5>Here we will create an API that will allow Users/Developer to order items from external systems</h5>
    <hr>
    <h5>We now put this feature of allowing users to generate an API key. Click the button to generate the API key</h5>
    <button class="btn blue waves-effect waves-light" id="api-key-btn" name="api-key-btn">Generate API Key</button>
    <p><small class="red-text hide" id="api_exists">You already have an API key. Check below.</small></p>
    <br><br><br>
    <strong>Your API Key: </strong>
    (Note that if your API key is in use by already running applications, generating a new key will stop the app from
    functioning)
    <br>
    <small class="red-text">API key cannot be edited</small>
    <textarea class="materialize-textarea" name="api_key" id="api_key" cols="30" rows="10" disabled>
        <?=displayApiKey($api)?>
    </textarea>

    <br>
    <h3>Service description</h3>
    <div>
        We have a service/API that allows external applications to order and also pull all order stats by using order
        id. Let's do it
    </div>
    <!-- <form action="model/forms.php" method="post">
        <button class="btn blue waves-effect waves-light" name="api-key-btn">Generate API Key</button>
        id="api-key-btn"
        <input type="hidden" name="generate_api_key" value="true">
    </form> -->

</body>

</html>

<?php
function displayApiKey($api)
{
    $key = $api->fetchUserApiKey($_SESSION['user_id']);
    return $key['num_rows'] == 0 ? 'You don\'t have an API key' : $key['api_key'];
}