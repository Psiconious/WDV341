<?php
    session_start();
    require 'php/page-handler.php';
    require '../dbConnect.php';
    
    $admin = false;
    $id = '';
    $errorMessage = '';

    $cardName = "";
    $cardType = "";
    $monsterAttribute = "";
    $monsterType = "";
    $monsterLevel = "";
    $monsterATK = "";
    $monsterDEF = "";
    $stProperty = "";
    $cardEffect = "";

    
    if(isset($_SESSION['validUser'])){
        $userName = $_SESSION['username'];
        require "../dbConnect.php";
        //prepare statement
        $adminSQL = "SELECT admin FROM yugioh_db_users WHERE username = :user";
        $stmt = $conn->prepare($adminSQL);
        try{
            //bind params
            $stmt->bindParam(':user', $userName);
            //execute
            $stmt->execute();
            //set fetch mode
            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            //assign admin
            $fetchedData = $stmt->fetch();
            $admin = $fetchedData['admin'];
        }
        catch(PDOException $e){
            $admin = false;
        }
    }

    if(isset($_GET['cardID'])){
        $id = $_GET['cardID'];
        
        $sql = 'SELECT * FROM yugioh_db_cards WHERE cardID = :id';
        
        try{
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(':id', $id);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $card = $stmt->fetch();

            $cardName = $card['cardname'];
            $cardType = $card['cardtype'];
            $monsterAttribute = $card['cardattribute'];
            $monsterType = $card['monstertype'];
            $monsterLevel = $card['monsterlevel'];
            $monsterATK = $card['monsteratk'];
            $monsterDEF = $card['monsterdef'];
            $stProperty = $card['spelltrapproperty'];
            $cardEffect = $card['cardeffect'];
        }
        catch(PDOException $e){
            $errorMessage = 'Error Connecting to the Database.';
        }
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
    <title>Card View</title>
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
                    <label for="cardName">Name:</label>
                    <input type="text" name="cardName" id="cardName" value="<?=$cardName?>" <?=(!$admin)? "disabled" : ""?>>
                    <label for="cardType">Type:</label>
                    <select name="cardType" id="cardType" <?=(!$admin)? "disabled" : ""?>>
                        <option value="monster" <?=($cardType == 'monster')? 'selected': ''?>>Monster</option>
                        <option value="spell" <?=($cardType == 'spell')? 'selected': ''?>>Spell</option>
                        <option value="trap" <?=($cardType == 'trap')? 'selected': ''?>>Trap</option>
                    </select>
                    <label for="cardAttribute">Attribute:</label>
                    <select name="cardAttribute" id="cardAttribute" <?=(!$admin)? "disabled" : ""?>>
                        <option value="" <?=($monsterAttribute == null)? 'selected': ''?>></option>
                        <option value="dark" <?=($monsterAttribute == 'dark')? 'selected': ''?>>Dark</option>
                        <option value="divine" <?=($monsterAttribute == 'divine')? 'selected': ''?>>Divine</option>
                        <option value="earth" <?=($monsterAttribute == 'earth')? 'selected': ''?>>Earth</option>
                        <option value="fire" <?=($monsterAttribute == 'fire')? 'selected': ''?>>Fire</option>
                        <option value="light" <?=($monsterAttribute == 'light')? 'selected': ''?>>Light</option>
                        <option value="water" <?=($monsterAttribute == 'water')? 'selected': ''?>>Water</option>
                        <option value="wind" <?=($monsterAttribute == 'wind')? 'selected': ''?>>Wind</option>
                    </select>
                    <label for="monsterType">Monster Type:</label>
                    <select name="monsterType" id="monsterType" <?=(!$admin)? "disabled" : ""?>>
                        <option value="" <?=($monsterType == null)? 'selected': ''?>></option>
                        <option value="aqua" <?=($monsterType == 'aqua')? 'selected': ''?>>Aqua</option>
                        <option value="beast" <?=($monsterType == 'beast')? 'selected': ''?>>Beast</option>
                        <option value="beast-warrior" <?=($monsterType == 'beast-warrior')? 'selected': ''?>>Beast-Warrior</option>
                        <option value="creator god" <?=($monsterType == 'creator god')? 'selected': ''?>>Creator God</option>
                        <option value="cyberse" <?=($monsterType == 'cyberse')? 'selected': ''?>>Cyberse</option>
                        <option value="dinosaur" <?=($monsterType == 'dinosaur')? 'selected': ''?>>Dinosaur</option>
                        <option value="divine-beast" <?=($monsterType == 'divine-beast')? 'selected': ''?>>Divine-Beast</option>
                        <option value="dragon" <?=($monsterType == 'dragon')? 'selected': ''?>>Dragon</option>
                        <option value="fairy" <?=($monsterType == 'fairy')? 'selected': ''?>>Fairy</option>
                        <option value="fiend" <?=($monsterType == 'fiend')? 'selected': ''?>>Fiend</option>
                        <option value="fish" <?=($monsterType == 'fish')? 'selected': ''?>>Fish</option>
                        <option value="insect" <?=($monsterType == 'insect')? 'selected': ''?>>Insect</option>
                        <option value="machine" <?=($monsterType == 'machine')? 'selected': ''?>>Machine</option>
                        <option value="plant" <?=($monsterType == 'plant')? 'selected': ''?>>Plant</option>
                        <option value="psychic" <?=($monsterType == 'psychic')? 'selected': ''?>>Psychic</option>
                        <option value="pyro" <?=($monsterType == 'pyro')? 'selected': ''?>>Pyro</option>
                        <option value="reptile" <?=($monsterType == 'reptile')? 'selected': ''?>>Reptile</option>
                        <option value="sea serpent" <?=($monsterType == 'sea serpent')? 'selected': ''?>>Sea Serpent</option>
                        <option value="spellcaster" <?=($monsterType == 'spellcaster')? 'selected': ''?>>Spellcaster</option>
                        <option value="thunder" <?=($monsterType == 'thunder')? 'selected': ''?>>Thunder</option>
                        <option value="warrior" <?=($monsterType == 'warrior')? 'selected': ''?>>Warrior</option>
                        <option value="winged beast" <?=($monsterType == 'winged beast')? 'selected': ''?>>Winged Beast</option>
                        <option value="wyrm" <?=($monsterType == 'wyrm')? 'selected': ''?>>Wyrm</option>
                        <option value="zombie" <?=($monsterType == 'zombie')? 'selected': ''?>>Zombie</option>
                    </select>
                    <label for="monsterLevel">Level:</label>
                    <input type="text" name="monsterLevel" id="monsterLevel" value="<?=$monsterLevel?>" <?=(!$admin)? "disabled" : ""?>>
                    <label for="monsterATK">Attack:</label>
                    <input type="text" name="monsterATK" id="monsterATK" value="<?=$monsterATK?>" <?=(!$admin)? "disabled" : ""?>>
                    <label for="monsterDEF">Defense:</label>
                    <input type="text" name="monsterDEF" id="monsterDEF" value="<?=$monsterDEF?>" <?=(!$admin)? "disabled" : ""?>>
                    <label for="cardEffect">Effect:</label>
                    <textarea name="cardEffect" id="cardEffect" cols="30" rows="10"><?=$cardEffect?></textarea>
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