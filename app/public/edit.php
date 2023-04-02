<?php

declare(strict_types=1);

session_start();

include_once 'cms-config.php';
include_once ROOT . "/cms-includes/global-functions.php";
include_once ROOT . "/cms-includes/models/Database.php";
include_once ROOT . "/cms-includes/models/Page.php";

$page_database = new Page();

$title = 'Edit Page';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $result = $page_database->one_page($id);

    $form_title = $result['title'];
    echo $form_title;
    $form_content = $result['content'];
    echo $form_content;
    $form_id = $result['id'];
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $form_title = $_POST['title'];
    $form_content = $_POST['content'];
    $form_id = $_POST['id'];

    print_r($_POST);

    if (!empty($form_title)) {

        $result = $page_database->edit_page($form_id, $form_content, $form_title);

        $_SESSION['message'] = "Successfully edited page";
        header("location: pages.php");
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

    <?php include ROOT . '/cms-includes/partials/nav.php' ?>

    <h1>Edit page</h1>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

        <input type="number" name="id" id="id" value="<?= $form_id ?>" hidden>

        <label for="title">Title</label>
        <input type="text" name="title" id="title" value="<?= $form_title ?>">

        <label for="content">Content</label>
        <textarea name="content" id="content" cols="30" rows="10"> <?php echo $form_content ?></textarea>

        <input type="submit" value="Update page">
    </form>
</body>

</html>