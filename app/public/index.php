<?php

declare(strict_types=1);

session_start();

include_once 'cms-config.php';
include_once ROOT . "/cms-includes/global-functions.php";
include_once ROOT . "/cms-includes/models/Database.php";
include_once ROOT . "/cms-includes/models/User.php"; 


$title = 'Dashboard';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>

<link rel="stylesheet" href="/cms-content/styles/style.css" type="text/css">

</head>
<body>
    <div class="wrapper_start">

    <h1>Space| Work</h1>

    <button class="button"><a href="login.php">Login to Space</a></button>
    <a href="register.php" id="register_account">Got no account? Let's create one to join the force</a>
    </div>
</body>
</html>