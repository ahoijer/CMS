<?php 
declare(strict_types=1);

session_start();

include_once 'cms-config.php';
include_once ROOT . "/cms-includes/global-functions.php";
include_once ROOT . "/cms-includes/models/Database.php";
include_once ROOT . "/cms-includes/models/Page.php";   

$page_database = new Page();

$id = $_GET['id'];

$result = $page_database->delete_page($id);

if($result == 1) {
    header('Location: pages.php');
} else {
    header('Location: pages.php');
    $_SESSION['message'] = 'Could not delete this page';
    exit();
}

?>