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
                        <li><a href="index.php" class="active">Home</a></li>
                        <li><a href="rules.php">How To Play</a></li>
                        <li><a href="card_database.php">Cards</a></li>
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
                    </div>
                    <div class="col-3">
                        <h2>How to use this site</h2>
                        This site primary use is searching card based on criteria selected by the user.
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