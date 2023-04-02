<?php 
declare(strict_types=1);


session_start();

include_once 'cms-config.php';
include_once ROOT . "/cms-includes/global-functions.php";
include_once ROOT . "/cms-includes/models/Database.php";
include_once ROOT . "/cms-includes/models/Parsedown.php";
include_once ROOT . "/cms-includes/models/Page.php";


$page_database = new Page();

$title = 'View';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = $page_database->one_page($id);


    $html_title = $result['title'];
    $html_content = $result['content'];

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
<body id="body_view">
    <div class="wrapper">
    <div class="sidebar">
<?php include ROOT . '/cms-includes/partials/nav.php' ?>
</div>
</div>
<?php include ROOT . '/cms-includes/partials/header.php' ?>


<div class="wrapper_view">
    <?php 
    $Parsedown = new Parsedown();
    $html_title = $Parsedown->text($html_title);   
    $html_content = $Parsedown->text($html_content);


    echo $html_title;
    echo $html_content;
    ?>
</div>
<?php include ROOT . '/cms-includes/partials/footer.php' ?>

</body>
</html>