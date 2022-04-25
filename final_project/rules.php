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
    <title>How to Play</title>
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
                    <h1>How to play Yu-Gi-Oh!</h1>
                    <h2>Understanding the cards</h2>
                    <div class="col-2">
                        <div class="clear">
                        <h3>Monster Cards</h3>
                            <img class="float-right" src="images/AshBlossomJoyousSpring.webp" alt="Monster Card Example">
                            <p>  
                                Monster cards are summoned to attack your opponent&#39s Life Points and defend your own.
                                They are usually orange (effect) or yellow (normal) in color, but there are many other colors as well. 
                                Monsters have levels, ranging from 1-12, which are indicated by the stars along the top, and a symbol in the top right corner indicating Attribute. 
                                Above the card text, the Type, the kind of monster, and monster abilities such as Tuner or Flip are written in bold. 
                                The Attack and Defense stats are listed as ATK and DEF along the bottom.
                            </p> 
                        </div>
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