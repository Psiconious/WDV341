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
                        <li><a href="contact_form.php" class="<?php active('contact_form.php');?>">Contact Us</a></li>
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
                    <div class="col-3">
                        <h2>About this site</h2>
                        Welcome to the dueling database. This website is a database dedicated to the Yu-Gi-Oh! Duel Monster Card Game.
                        Here you can look up any card apart of this game by clicking on the card link or click <a href="card_database.php">here</a>.
                        If you are not familiar with how the Yu-Gi-Oh! Duel Monster Card Game work you can check out our how to play link or click <a href="rules.php">here</a>.
                        The primary use of this site is to search cards base on user entered criteria.
                    </div>
                    <div class="col-3">
                        <h2>What is Yu-Gi-Oh!</h2>
                        The Yu-Gi-Oh! Trading Card Game is a Japanese collectible card game developed and published by Konami. 
                        It is based on the fictional game of Duel Monsters created by manga artist Kazuki Takahashi, which appears in portions of the manga franchise Yu-Gi-Oh! and is the central plot device throughout its various anime adaptations and spinoff series.
                        The trading card game was launched by Konami in 1999 in Japan and March 2002 in North America. 
                        It was named the top selling trading card game in the world by Guinness World Records on July 7, 2009, having sold over 22 billion cards worldwide. 
                        As of March 31, 2011, Konami Digital Entertainment Co., Ltd. Japan sold 25.2 billion cards globally since 1999. 
                        As of January 2021, the game is estimated to have sold about 35 billion cards worldwide and grossed over ¥1 trillion ($9.64 billion). 
                        Yu-Gi-Oh! Speed Duel, a faster and simplified version of the game, was launched worldwide in January 2019. 
                        Another faster-paced variation, Yu-Gi-Oh! Rush Duel, launched in Japan in April 2020. 
                    </div>
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