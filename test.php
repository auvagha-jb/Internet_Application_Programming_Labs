<?php
if (isset($_POST['test-rename'])) {
    rename('test/', $_POST['folder'] . '/');
}
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include_once 'helpers/css-js.php';?>
    <title>Document</title>
</head>

<body>
    <!-- action="model/Forms.php" -->
    <form method="POST" action="model/file_upload.php" enctype="multipart/form-data" id="test-form">
        <input type="file" name="image" id="image">
        <input type="text" name="meh" id="meh">
        <button type="submit" name="test-upload" class="submit-btn">Submit</button>
    </form>
    <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
        <input type="text" name="folder" id="folder">
        <button type="submit" name="test-rename">Rename</button>
    </form>
</body>

</html>