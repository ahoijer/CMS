<?php
    session_start();

    
include_once 'cms-config.php';
include_once ROOT . "/cms-includes/global-functions.php";
include_once ROOT . "/cms-includes/models/Database.php";
include_once ROOT . "/cms-includes/models/Template.php";
include_once ROOT . "/cms-includes/models/User.php";
include_once ROOT . "/cms-includes/models/Page.php";
    
    if (!isset($_SESSION["user_id"])) {
        header("location: login.php");
        exit();
    }

    // Query the database
    // $sqlquery = "SELECT * FROM journal";
    // $result = $pdo->query($sqlquery);

    $page = new Page(); 

    $title = 'Create page';

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user_id = $_SESSION['user_id'];

        $form_title = trim($_POST['title']);        
        $form_content = trim($_POST['content']);



        // Check if there is any text from user
        if (!empty($form_title || $form_content)) {
            $pdo = new PDO('mysql:host=mysql;dbname=db_lamp_app' , 'db_user' , 'db_password');

            $query = "INSERT INTO page (id, title, content) VALUES (NULL, '$form_title', '$form_content')";
            $stmt = $pdo->query($query);

            $_SESSION['message'] = "Successfully added page";
            header("location: pages.php");
        }
    }  
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/mvp.css@1.12/mvp.css"> 
    <title>Create Crud App</title>
</head>
<body>
<?php 
$create_page = $page->setup();

?>
    <main>
    <h1><?php echo $title ?></h1>
    <a href="index.php">Back</a>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="title">Title</label>
        <input type="text" name="title" id="title">
        <label for="content">Content</label>
        <textarea name="content" id="content" cols="30" rows="10">

        </textarea>

        <input type="submit" value="Add page">
    </form>


    </main>
</body>
</html>