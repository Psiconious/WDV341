<?php
session_start();

$tableRowColor = true;
$errorMessage = "";
$admin = false;

if (isset($_SESSION['validUser'])) {
    $userName = $_SESSION['username'];
    require "../dbConnect.php";
    //prepare statement
    $adminSQL = "SELECT admin FROM yugioh_db_users WHERE username = :user";
    $stmt = $conn->prepare($adminSQL);
    try {
        //bind params
        $stmt->bindParam(':user', $userName);
        //execute
        $stmt->execute();
        //set fetch mode
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        //assign admin
        $fetchedData = $stmt->fetch();
        $admin = $fetchedData['admin'];
    } catch (PDOException $e) {
        $admin = false;
    }
}

require 'php/page-handler.php';
require "../dbConnect.php";

$sql = 'SELECT * FROM yugioh_db_cards';

try {
    //prepare statement
    $stmt = $conn->prepare($sql);
    //execute
    $stmt->execute();
    //setting fetch mode to php assoicate array
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $errorMessage = "Unable to connect to database";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/table.css">
    <script src="javascript/menu-handler.js"></script>
    <style>
        @media (max-width: 600px) {
            .container {
                width: initial;
            }

            section {
                justify-content: flex-start;
            }
        }
    </style>
    <title>Card Database</title>
</head>

<body>
    <div class="wrapper">
        <div class="front">
            <header>
                <div class="logo">Dueling Database</div>
                <nav>
                    <ul>
                        <li><a href="index.php" class="<?php active('index.php'); ?>">Home</a></li>
                        <li><a href="rules.php" class="<?php active('rules.php'); ?>">How To Play</a></li>
                        <li><a href="card_database.php" class="<?php active('card_database.php'); ?>">Cards</a></li>
                        <?php
                        if (isset($_SESSION['validUser'])) {
                        ?>
                            <li><a href=""><?= $userName ?></a></li>
                            <li><a href="logout.php">Sign Out</a></li>
                        <?php
                        } else {
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
                    <span><?= $errorMessage ?></span>
                    <div class="responsive-table">
                        <div class="responsive-table-header">
                            <div class="table-header-cell">
                                Card Name
                            </div>
                            <div class="table-header-cell">
                                Card Type
                            </div>
                            <div class="table-header-cell">
                                Attribute
                            </div>
                            <div class="table-header-cell">
                                Type
                            </div>
                            <div class="table-header-cell">
                                Level/Rank/Rating
                            </div>
                            <div class="table-header-cell">
                                S/T Property
                            </div>
                        </div>
                        <div class="responsive-table-body">
                            <?php
                            while ($row = $stmt->fetch()) {
                            ?>
                                <div class="responsive-table-row <?= ($tableRowColor) ? "row-light" : "row-dark" ?>">
                                    <a href="cardview.php?cardID=<?= $row['cardID'] ?>">
                                        <div class="table-body-cell">
                                            <?= $row['cardname'] ?>
                                        </div>
                                        <div class="table-body-cell">
                                            <?= $row['cardtype'] ?>
                                        </div>
                                        <div class="table-body-cell">
                                            <?= ($row['cardattribute'] == null) ? "-" : $row['cardattribute'] ?>
                                        </div>
                                        <div class="table-body-cell">
                                            <?= ($row['monstertype'] == null) ? "-" : $row['monstertype'] ?>
                                        </div>
                                        <div class="table-body-cell">
                                            <?= ($row['monsterlevel'] == null) ? "-" : $row['monsterlevel'] ?>
                                        </div>
                                        <div class="table-body-cell">
                                            <?= ($row['spelltrapproperty'] == null) ? "-" : $row['spelltrapproperty'] ?>
                                        </div>
                                    </a>
                                </div>
                            <?php
                                $tableRowColor = !$tableRowColor;
                            }
                            ?>
                        </div>
                        <div class="responsive-table-footer">
                            <div class="table-footer-cell"></div>
                            <div class="table-footer-cell"></div>
                            <div class="table-footer-cell"></div>
                            <div class="table-footer-cell"></div>
                            <div class="table-footer-cell"></div>
                            <div class="table-footer-cell"><?= ($admin) ? '<a href="cardview.php"><input type="button" value="Add New"></a>' : "" ?></div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <div class="trail">
            <footer>
                &copy<?= date('Y') ?> Trever Cluney
            </footer>
        </div>
    </div>
</body>

</html>