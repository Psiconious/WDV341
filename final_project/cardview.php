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
    else if(!$admin){
        header('Location: card_database.php');
    }
    
    if(isset($_POST['submit']) && $admin){
        $action = $_POST['submit'];
        if($action == 'add'){
            $valid = true;
            $cardName = $_POST['cardName'];
            $cardType =  $_POST['cardType'];
            $monsterAttribute =  $_POST['cardAttribute'];
            $monsterType =  $_POST['monsterType'];
            $monsterLevel =  $_POST['monsterLevel'];
            $monsterATK =  $_POST['monsterATK'];
            $monsterDEF =  $_POST['monsterDEF'];
            $stProperty =  $_POST['stProperty'];
            $cardEffect =  $_POST['cardEffect'];
            $errorMessage = "<ul>";

            $sql = "INSERT INTO yugioh_db_cards (cardname, cardtype, cardattribute, monstertype, monsterlevel, monsteratk, monsterdef, spelltrapproperty, cardeffect) VALUES (:name, :cardtype, :attribute, :monstertype, :level, :atk, :def, :stprop, :effect)";
            $stmt = $conn->prepare($sql);

            try{
                if($cardName == ""){
                    $valid = false;
                    $errorMessage .= "<li>name field is blank</li>";
                }
                if($cardEffect == ""){
                    $valid = false;
                    $errorMessage .= "<li>effect field is blank</li>";
                }
                if($stProperty == ""){
                    $stProperty = null;
                }
                if($monsterLevel != ""){
                    if(is_numeric($monsterLevel)){
                        if((int)$monsterLevel > 0 && (int)$monsterLevel <= 12){
                            $monsterLevel = (int)$monsterLevel;
                        }
                        else{
                            $valid = false;
                            $errorMessage .= "<li>monster level out of range , expected range: ( 1 - 12 )</li>";
                        }
                    }
                    else{
                        $valid = false;
                        $errorMessage .= "<li>monster level must be a whole number</li>";
                    }
                }
                else{
                    $monsterLevel = null;
                }
                if($monsterATK != ""){
                    if(is_numeric($monsterATK)){
                        if((int)$monsterATK >= 0 && (int)$monsterATK < 100000){
                            $monsterATK = (int)$monsterATK;
                        }
                        else{
                            $valid = false;
                            $errorMessage .= "<li>monster attack out of range, expected range: ( 0 - 99999 )</li>";
                        }
                    }
                    else{
                        $valid = false;
                        $errorMessage .= "<li>monster attack must be a whole number</li>";
                    }
                }
                else{
                    $monsterATK = null;
                }
                if($monsterDEF != ""){
                    if(is_numeric($monsterDEF)){
                        if((int)$monsterDEF >= 0 && (int)$monsterDEF < 100000){
                            $monsterDEF = (int)$monsterDEF;
                        }
                        else{
                            $valid = false;
                            $errorMessage .= "<li>monster defense out of range, expected range: ( 0 - 99999 )</li>";
                        }
                    }
                    else{
                        $valid = false;
                        $errorMessage .= "<li>monster defense must be a whole number</li>";
                    }
                }
                else{
                    $monsterDEF = null;
                }
                if($valid){
                    $stmt->bindParam(':name', $cardName);
                    $stmt->bindParam(':cardtype', $cardType);
                    $stmt->bindParam(':attribute', $monsterAttribute);
                    $stmt->bindParam(':monstertype', $monsterType);
                    $stmt->bindParam(':level', $monsterLevel);
                    $stmt->bindParam(':atk', $monsterATK);
                    $stmt->bindParam(':def', $monsterDEF);
                    $stmt->bindParam(':stprop', $stProperty);
                    $stmt->bindParam(':effect', $cardEffect);

                    $stmt->execute();

                    $redirctSQl = "SELECT cardID FROM yugioh_db_cards WHERE cardname = :name";
                    $redirectSTMT = $conn->prepare($redirctSQl);

                    $redirectSTMT->bindParam(':name', $cardName);

                    $redirectSTMT->execute();

                    $redirectSTMT->setFetchMode(PDO::FETCH_ASSOC);

                    $id = $redirectSTMT->fetch();

                    header('Location: cardview.php?cardID='. $id['cardID']);
                }
            }
            catch(PDOException $e){
                $errorMessage .= "<li>Failure to add card to database please try again.</li>";
                if($e->getCode() == 23000){
                    $errorMessage .= "<li>Cannot enter $cardName into the database already exist</li>";
                }
            }
            $errorMessage .= "</ul>";
        }
        else if($action == 'edit'){
        }
        else if($action == 'delete'){
        }
        else{
            $errorMessage = 'Error occured while submitting form please try again';
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
    <link rel="stylesheet" href="css/card.css">
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
                    <span class="errormessages"><?=$errorMessage?></span>
                    <form action="cardview.php<?=(isset($_GET['cardID']))? "?cardID=$id": ""?>" method="post">
                        <label for="cardName">Name:</label>
                        <input type="text" name="cardName" id="cardName" value="<?=$cardName?>" <?=(!$admin)? "disabled" : ""?> required>
                        <label for="cardType">Type:</label>
                        <select name="cardType" id="cardType" <?=(!$admin)? "disabled" : ""?>>
                            <option value="monster" <?=($cardType == 'monster')? 'selected': ''?>>Monster</option>
                            <option value="spell" <?=($cardType == 'spell')? 'selected': ''?>>Spell</option>
                            <option value="trap" <?=($cardType == 'trap')? 'selected': ''?>>Trap</option>
                        </select>
                        <label for="stProperty">Spell/Trap Property:</label>
                        <select name="stProperty" id="stProperty" <?=(!$admin)? "disabled" : ""?>>
                            <option value="" <?=($stProperty == null)? 'selected': ''?>></option>
                            <option value="normal" <?=($stProperty == 'normal')? 'selected': ''?>>Normal</option>
                            <option value="continuous" <?=($stProperty == 'continuous')? 'selected': ''?>>Continuous</option>
                            <option value="equip" <?=($stProperty == 'equip')? 'selected': ''?>>Equip</option>
                            <option value="field" <?=($stProperty == 'field')? 'selected': ''?>>Field</option>
                            <option value="quick-play" <?=($stProperty == 'quick-play')? 'selected': ''?>>Quick-Play</option>
                            <option value="ritual" <?=($stProperty == 'ritual')? 'selected': ''?>>Ritual</option>
                            <option value="counter" <?=($stProperty == 'counter')? 'selected': ''?>>Counter</option>
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
                            <option value="rock" <?=($monsterType == 'rock')? 'selected': ''?>>Rock</option>
                            <option value="sea serpent" <?=($monsterType == 'sea serpent')? 'selected': ''?>>Sea Serpent</option>
                            <option value="spellcaster" <?=($monsterType == 'spellcaster')? 'selected': ''?>>Spellcaster</option>
                            <option value="thunder" <?=($monsterType == 'thunder')? 'selected': ''?>>Thunder</option>
                            <option value="warrior" <?=($monsterType == 'warrior')? 'selected': ''?>>Warrior</option>
                            <option value="winged beast" <?=($monsterType == 'winged beast')? 'selected': ''?>>Winged Beast</option>
                            <option value="wyrm" <?=($monsterType == 'wyrm')? 'selected': ''?>>Wyrm</option>
                            <option value="zombie" <?=($monsterType == 'zombie')? 'selected': ''?>>Zombie</option>
                        </select>
                        <label for="monsterLevel">Level:</label>
                        <select name="monsterLevel" id="monsterLevel" <?=(!$admin)? "disabled" : ""?>>
                            <option value="" <?=($monsterLevel == null)? 'selected': ''?>></option>
                            <option value="1"<?=($monsterLevel == 1)? 'selected': ''?>>1</option>
                            <option value="2" <?=($monsterLevel == 2)? 'selected': ''?>>2</option>
                            <option value="3" <?=($monsterLevel == 3)? 'selected': ''?>>3</option>
                            <option value="4" <?=($monsterLevel == 4)? 'selected': ''?>>4</option>
                            <option value="5" <?=($monsterLevel == 5)? 'selected': ''?>>5</option>
                            <option value="6" <?=($monsterLevel == 6)? 'selected': ''?>>6</option>
                            <option value="7" <?=($monsterLevel == 7)? 'selected': ''?>>7</option>
                            <option value="8" <?=($monsterLevel == 8)? 'selected': ''?>>8</option>
                            <option value="9" <?=($monsterLevel == 9)? 'selected': ''?>>9</option>
                            <option value="10" <?=($monsterLevel == 10)? 'selected': ''?>>10</option>
                            <option value="11" <?=($monsterLevel == 11)? 'selected': ''?>>11</option>
                            <option value="12" <?=($monsterLevel == 12)? 'selected': ''?>>12</option>
                        </select>
                        <label for="monsterATK">Attack:</label>
                        <input type="text" name="monsterATK" id="monsterATK" value="<?=$monsterATK?>" <?=(!$admin)? "disabled" : ""?>>
                        <label for="monsterDEF">Defense:</label>
                        <input type="text" name="monsterDEF" id="monsterDEF" value="<?=$monsterDEF?>" <?=(!$admin)? "disabled" : ""?>>
                        <label for="cardEffect">Effect:</label>
                        <textarea name="cardEffect" id="cardEffect" cols="50" rows="10" required><?=$cardEffect?></textarea>
                        <div class="card-form-buttons">
                            <?php
                                if($admin){
                                    if(!isset($_GET['cardID'])){
                            ?>
                                        <input type="submit" name="submit" value="add" class="normal">
                            <?php
                                    }
                                    else{
                            ?>
                                        <input type="submit" name="submit" value="edit" class="normal">
                                        <input type="submit" name="submit" value="delete" class="warning">
                            <?php
                                    }
                                }
                            ?>
                        </div>
                    </form>
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