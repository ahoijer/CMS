<?php 
session_start();

    
include_once 'cms-config.php';
include_once ROOT . "/cms-includes/global-functions.php";
include_once ROOT . "/cms-includes/models/Database.php";
include_once ROOT . "/cms-includes/models/User.php";
include_once ROOT . "/cms-includes/models/Page.php";

$title = 'Users';

$user_database = new User();


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

$result = $user_database->all_users();

foreach ($result as $row) {

    
    $id = $row['id'];
        $username = trim($row['username']);

        echo "<div class='page_info'>
        <img src='chewbacca.jpg'/> 
        <p class='username'>" . $username . "</p> 
        </div>";
}

?>
    
</body>
</html>