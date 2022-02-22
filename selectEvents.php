<?php
    //connect to the database
    include 'dbConnect.php';

    //SQL command
    $SQL = "SELECT name,date FROM wdv341_events";

    //prepare statement
    $stmt = $conn->prepare($SQL);

    //execute
    $stmt->execute();

    //setting fetch mode to php assoicate array
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    
?>

<style>
    span{
        margin-right: 10px;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>WDV341 Intro PHP</h1>
    <h2>Unit-7 Select data</h2>
    <h3>Current Events</h3>
    <?php
        while( $row=$stmt->fetch()){
            echo "<p>\n\t\t";
            echo "<span>";
            echo $row['name'];
            echo "</span>\n\t\t";
            echo "<span>";
            echo $row['date'];
            echo "</span>\n\t";
            echo "</p>\n\t";
        }
    ?>
</body>
</html>