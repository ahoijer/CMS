<?php
declare(strict_types=1);

// use LDAP\Result;

session_start();

include_once 'cms-config.php';
include_once ROOT . "/cms-includes/global-functions.php";
include_once ROOT . "/cms-includes/models/Database.php";
include_once ROOT . "/cms-includes/models/Template.php";
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
        header('location: index.php');
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
        <h1>Login</h1>

        <form action="" method="post">

            <label for="username">Username</label>
            <input type="text" name="username" id="username">

            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            <input type="submit" value="Login">
        </form>

        <p>Don't got any account? <a href="register.php">Register here</a></p>

    </main>
</body>

</html>