<?php 
declare(strict_types=1);


session_start();

include_once 'cms-config.php';
include_once ROOT . "/cms-includes/global-functions.php";
include_once ROOT . "/cms-includes/models/Database.php";
include_once ROOT . "/cms-includes/models/Template.php";
include_once ROOT . "/cms-includes/models/User.php";

$user = new User();

$title = 'Register';

// $username = '';
// $password = '';

// print_r($_REQUEST);

// print_r($_POST);

// print_r($_SERVER);

if($_POST)
{

    $username = $_POST['username'];

    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $result = $user->register($username, $hashed_password);
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
        <h1>Register</h1>

        <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="post">

            <label for="username">Username</label>
            <input type="text" name="username" id="username">

            <label for="password">Password</label>
            <input type="password" name="password" id="password">

            <input type="submit" value="Register">
        </form>

    </main>
</body>
</html>