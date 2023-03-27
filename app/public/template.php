<?php
declare(strict_types=1);
include_once 'cms-config.php';
include_once ROOT . '/cms-includes/global-functions.php';
include_once ROOT . '/cms-includes/models/Database.php';
include_once ROOT . '/cms-includes/models/Template.php';


// use Temmplate
$template = new Template();

// default values
$information = "";
$position = 5;

// hantera ev POST request
if ($_POST) {
    print_r2($_POST);

    //  använd $template för att uppdatera tabellen

    // kolla att informationen är ett visst antal tecken innan den sparas
    $information = $_POST['information'];

    // ev dubbelkolla att värdet är ok, dvs mellan ex 1 och 10
    $position = $_POST['position'];


    $result = $template->insertOne($information, $position);

}


// use Database
// klassen protected - kan inte nå åtkomst
// Call to protected Database::__construct() from invalid context
// $database = new Database();


$title = "Template";

?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="/cms-content/styles/style.css">
</head>
<body>
    

    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">


        <input type="text" name="information" placeholder="Ange information" value="<?= $information ?>">
        <input type="number" name="position" min="1" max="10" value="<?= $position ?>">
        <input type="submit" value="Spara till databasen">


    </form>



    <?php include ROOT . '/cms-includes/partials/header.php'; ?>
    <?php include ROOT . '/cms-includes/partials/nav.php'; ?>

    <h1><?= $title ?></h1>

    <?php

    new DisplayDBVersion();

    // use setup method - create table
    $result = $template->setup();


    // testa åtkomst utan klassen Database
    // $dsn = "mysql:host=". DB_HOST .";dbname=". DB_NAME;
    // $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);

    // print_r($pdo);

    // PDO query()
    // Enkel fråga utan variabler
    // $sql = "SELECT * FROM template";

    // fråga efter ett specifikt innehåll
    // $sql = "SELECT * FROM template WHERE id = 2";
    
    // använd en variabel för "value" - i det här fallet id
    // $value = 3;
    // $sql = "SELECT * FROM template WHERE id = " . $value;

    // vad händer om vi äventyrar en dynamiskt uppbyggd sql fråga
    // $value = "4 OR 1=1";
    // $sql = "SELECT * FROM template WHERE id = " . $value;

    // $value = "4; RENAME TABLE template TO temp";
    // $sql = "SELECT * FROM template WHERE id = " . $value;

    // $value = "4; DROP TABLE template";
    // $sql = "SELECT * FROM template WHERE id = " . $value;

    // se upp med att skapa dynamiskt uppbyggda sql frågor - googla "Bobby tables";
    //  SQL injection

    // $stmt = $pdo->query($sql);
    // $result = $stmt->fetchAll();
    // print_r2($result);

    // För att förhindra SQL injection används placeholders, typ
    // $sql = "SELECT * FROM template WHERE id = :value";
    // PDO metod prepare()
    // se klassen Template.php


    // använd metoden insertOne()
    // $result = $template->insertOne('Gotland är en ö', 4);
    // print_r2($result);

    // testa att skicka parametrar i annan ordning
    // $result = $template->insertOne('Skåne ligger söderut', 3);
    // print_r2($result);


    // delete
    // $result = $template->deleteOne(9);
    // print_r2($result);


    // update
    // $result = $template->updateOne(1, 'Sverige är ganska långsträckt');
    // print_r2($result);


    $result = $template->selectAll();
    print_r2($result);

    // order by...
    $result = $template->selectAllOrderBy('position', true);
    print_r2($result);


    ?>

    <?php include ROOT . '/cms-includes/partials/footer.php'; ?>

</body>
</html>