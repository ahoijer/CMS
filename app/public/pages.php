<?php 
session_start();

    
include_once 'cms-config.php';
include_once ROOT . "/cms-includes/global-functions.php";
include_once ROOT . "/cms-includes/models/Database.php";
include_once ROOT . "/cms-includes/models/User.php";
include_once ROOT . "/cms-includes/models/Page.php";

$title = 'Pages';

$page_database = new Page();

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
<div class="wrapper">
    <div class="sidebar">
<?php include ROOT . '/cms-includes/partials/nav.php' ?>
</div>
</div>
<div class="wrapper_pages">
<?php 

$result = $page_database->all_pages();

foreach ($result as $row) {

    
    $id = $row['id'];
        $title = trim($row['title']);
        $content = trim($row['content']);
        $time_stamp = $row['time_stamp'];
        $created_by = $row['user_id'];
        
        echo "<div class='page_info'>
        <img src='chewbacca.jpg'/> .
        <p class='title'>" . $title . "</p> .
        <p class='content'>" . "Content: " . $content . "</p> 
        <p class='time_stamp'>" . "Time_Stamp: " . $time_stamp . "</p>
        <p class='created_by'>" . "Created_By: " . $created_by . "</p>
        <span> 
        <a href='delete.php?id=$id'>Delete</a>
        <a href='edit.php?id=$id'>Edit</a>
        <a href='viewpage.php?id=$id'>View</a>
        </span>
        </div>";
}

?>
    </div>
</body>
</html>