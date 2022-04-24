<?php
    session_start();

    if(isset($_SESSION['validUser'])){
        $userName = $_SESSION['username'];
    }

    require 'php/page-handler.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="javascript/menu-handler.js"></script>
    <title>Home</title>
</head>
<body>
    <div class="wrapper">
        <div class="front">
            <header>
                <div class="logo">Dueling Database</div>
                <nav>
                    <ul>
                        <li><a href="index.php" class="<?php active('index.php');?>">Home</a></li>
                        <li><a href="rules.php" class="<?php active('rules.php');?>">How To Play</a></li>
                        <li><a href="card_database.php" class="<?php active('card_database.php');?>">Cards</a></li>
                        <?php
                        if(isset($_SESSION['validUser'])){
                        ?>
                        <li><a href=""><?=$userName?></a></li>
                        <li><a href="logout.php">Sign Out</a></li>
                        <?php
                        }else{
                        ?>
                        <li><a href="signon.php">Sign In / Sign Up</a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </nav>
                <div class="menu-toggle" onclick="ToggleMenu()"><img src="icons/hamburger-menu.svg" alt="menu"></div>
            </header>
        </div>
        <div class="main">
            <section>
                <div class="container">
                    
                </div>
            </section>
        </div>
        <div class="trail">
            <footer>
                &copy<?=date('Y')?> Trever Cluney
            </footer>
        </div>
    </div>
</body>
</html>