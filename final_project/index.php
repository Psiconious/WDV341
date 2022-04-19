<?php
    session_start();

    if(isset($_SESSION['validUser'])){
        $userName = $_SESSION['username'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <h1>Main Page</h1>
    <?php
        if(!isset($_SESSION['validUser'])){
    ?>
    <a href="signon.php">Logon</a>
    <?php
        }
        else{
    ?>
    <span><?=$userName?></span>
    <?php
        }
    ?>
    <a href="logout.php">logout</a>
</body>
</html>