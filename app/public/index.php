<?php

declare(strict_types=1);

session_start();

include_once 'cms-config.php';
include_once ROOT . "/cms-includes/global-functions.php";
include_once ROOT . "/cms-includes/models/Database.php";
include_once ROOT . "/cms-includes/models/Template.php";
include_once ROOT . "/cms-includes/models/User.php";   

echo "Hello world";

$title = 'Dashboard';


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?></title>
</head>
<body>
    <?php include ROOT . '/cms-includes/partials/nav.php' ?>
<a href="logout.php">Logout</a>
</body>
</html>