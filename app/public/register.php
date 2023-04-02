<?php 
declare(strict_types=1);


session_start();

include_once 'cms-config.php';
include_once ROOT . "/cms-includes/global-functions.php";
include_once ROOT . "/cms-includes/models/Database.php";
include_once ROOT . "/cms-includes/models/User.php";

$user = new User();

$title = 'Register';


if($_POST)
{

    $username = $_POST['username'];

    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);


    $result = $user->register($username, $hashed_password);

    header('location: login.php');
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
$user_setup = $user->setup();
        // Write out message from other pages if exists
        if (isset($_SESSION['message']) && !empty($_SESSION['message'])) {
            echo "<article><aside><p>". $_SESSION['message'] . "</p></aside></article>";
            unset( $_SESSION['message']); // remove it once it has been written
        }

        ?>
    <main>
        <div class="wrapper_register">
        <h2>Space| Work</h2>

        <form action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>' method="post">

            <label for="username">Username:</label>
            <input type="text" name="username" id="username">

            <label for="password">Password:</label>
            <input type="password" name="password" id="password">

            <input type="submit" value="Join the force" class="button">
        </form>
        </div>
    </main>
</body>
</html>