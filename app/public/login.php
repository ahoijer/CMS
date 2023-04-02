<?php
declare(strict_types=1);

session_start();

include_once 'cms-config.php';
include_once ROOT . "/cms-includes/global-functions.php";
include_once ROOT . "/cms-includes/models/Database.php";
include_once ROOT . "/cms-includes/models/User.php";

$title = 'Login';

$user = new User();

if ($_POST) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    echo ($username . $password);

    $result = $user->login($username, $password);

    if ($result) {
        $_SESSION['user_id'] = $result['id'];
        $_SESSION['message'] = 'Sucessfully logged in';
        header('location: pages.php');
        exit();
    }
}


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

<?php 
        // Write out message from other pages if exists
        if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
            echo "<article><aside><p>". $_SESSION['message'] . "</p></aside></article>";
            unset( $_SESSION['message']); // remove it once it has been written
        }
        ?>
    <main>
        <div class="wrapper_login">
        <h2>Space| Work</h2>

        <form action="" method="post">

            <label for="username">Username:</label>
            <input type="text" name="username" id="username">

            <label for="password">Password:</label>
            <input type="password" name="password" id="password">

            <input type="submit" value="Take me to Space| Work" class="button">
        </form>

        <p>Oops, I am not with the force! <a href="register.php">| Join it here</a></p>
        </div>
    </main>
</body>

</html>