<?php
session_start();

if (isset($_SESSION['validUser'])) {
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
    <style>
        .main ul{
            line-height: 1.5em;
        }
        .main div.col-2{
            margin-bottom: 40px;
        }
        .main div.col-2:last-child{
            margin-bottom: 0;
        }
    </style>
    <title>How to Play</title>
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
                        <li><a href="contact_form.php" class="<?php active('contact_form.php');?>">Contact Us</a></li>
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
                <div class="container" style="font-family: sans-serif;">
                    <h1>How to play Yu-Gi-Oh!</h1>
                    <h2>Understanding the cards</h2>
                    <div class="col-2">
                        <div class="clear">
                            <h3>Monster Cards</h3>
                            <img class="float-right" src="images/AshBlossomJoyousSpring.webp"
                                alt="Monster Card Example">
                            <p>
                                Monster cards are summoned to attack your opponent&#39s Life Points and defend your own.
                                They are usually orange (effect) or yellow (normal) in color, but there are many other
                                colors as well.
                                Monsters have levels, ranging from 1-12, which are indicated by the stars along the top,
                                and a symbol in the top right corner indicating Attribute.
                                Above the card text, the Type, the kind of monster, and monster abilities such as Tuner
                                or Flip are written in bold.
                                The Attack and Defense stats are listed as ATK and DEF along the bottom.
                            </p>
                        </div>
                        <h3>Types of monsters</h3>
                        <ul>
                            <li>
                                Effect monsters have effects which affect the game, but normal monsters only have lore.
                                Effect Monsters are the most commonly used type of monster, as their effects can be
                                quite powerful. Normal monsters are not as useful, but have some good support and are
                                used in certain types of decks. Extra Deck monsters without an effect are Non-Effect
                                Monsters, neither Normal nor Effect monsters.
                            </li>
                            <li>
                                Tokens are a type of monster summoned by an effect. They can be represented by anything
                                small that can indicate attack and defense position. Token cards cannot be in either
                                deck, and can only exist face-up on the field. Therefore they can't be sent to Graveyard
                                or banished for cost, flipped face-down, or become Xyz Material. They are treated as
                                Normal monsters, and are given their name, attack, defense, level, attribute, and type
                                by the card used to summon them. Official Token cards are gray.
                            </li>
                            <li>
                                Fusion, Synchro, Xyz, and Link monsters cannot exist in the hand or deck, and must go in
                                the Extra Deck. Xyz monsters have black backgrounds, and Ranks instead of Levels.
                                Synchro monsters are white, Fusion monsters are violet, and Link monsters are blue with
                                a hex background. They each have their own specific summoning methods and must first be
                                Special Summoned using that method before they can be summoned any other way (revived
                                from the Graveyard, etc.). Some of these monsters have special requirements for the
                                monsters used to summon them (known as the materials), which are written on the first
                                line of the text.
                            </li>
                            <li>
                                Ritual monsters are blue, and also cannot be summoned unless they are first Ritual
                                Summoned. Most of them are summoned with a specific Spell.
                            </li>
                            <li>
                                Pendulum monsters can be any type of monster, and their background color fades to the
                                green color of spell cards on the bottom half of the card. Above the card text, there is
                                a box which contains that card's Pendulum Effects and has the Pendulum Scales on each
                                side. A Pendulum monster can be activated from the hand as a spell card in the left- and
                                right-most Spell/Trap Zones, which become Pendulum Zones while a Pendulum card is placed
                                in them. Unlike Field Spells, Pendulum cards cannot be replaced by putting another
                                Pendulum monster in the same zone. When a Pendulum monster would be sent from the field
                                to the graveyard, it is placed face-up on top of the Extra Deck instead, where it can be
                                resummoned to the field. If you have a Pendulum monster in both Pendulum Zones, you can
                                perform a Pendulum Summon (more on that later).
                            </li>
                            <li>
                                Possible monster abilities are Tuner, Spirit, Gemini, Flip, Union, and Toon. Tuner
                                monsters are necessary for Synchro Summons. The other types are self-explanatory.
                            </li>
                        </ul>
                    </div>
                    <div class="col-2">
                        <div class="clear">
                            <h3>Spell Cards</h3>
                            <img class="float-right" src="images/ForbiddenDroplet.webp" alt="Spell Card Example">
                            <p>
                                Spell cards are a greenish color. They are usually activated from your hand during your
                                turn, and have various effects. There are six different types of spells, and spells
                                other than normal spells will have an icon at the top right near the bold text
                                indicating their type.
                            </p>
                        </div>
                        <h3>Types of spells</h3>
                        <ul>
                            <li>Normal Spell cards are played from the hand onto a S/T zone on the field, and after their effect is applied, they are sent to the graveyard.</li>
                            <li>Continuous spell cards have a ∞ symbol. After they are played onto the field, they stay there unless removed in some way, and their effects are applied as long as they are on the field.</li>
                            <li>Quick-Play Spells have a lightning bolt symbol. They can be played during any part of your turn, and, if set, during your opponent's turn.</li>
                            <li>Field spells have a four-pointed star, and go in the Field Spell Zone when activated or set. Field spells affect the whole field, and stay there unless removed. If you activate a new Field Spell while you already control one in your Field Spell Zone, the previous one is destroyed. Both players can control a Field Spell at the same time.</li>
                            <li>Equip spells have a plus symbol. When activated, they are equipped onto a face-up monster on the field, and remain on the field unless removed. An Equip Spell Card is destroyed if the monster is no longer face-up on the field or is no longer a valid target.</li>
                            <li>Ritual Spell cards are indicated by a flame, and are used in the Ritual Summoning of a Ritual Monster. They work like Normal Spells, and usually require tributes from the field to summon the specified monster from the hand.</li>
                        </ul>
                    </div>
                    <div class="col-2">
                        <div class="clear">
                            <h3>Trap Cards</h3>
                            <img src="images/InfiniteImpermanence.webp" alt="Trap Card Example" class="float-right">
                            <p>
                            Traps are meant to be used during the opponent's turn to disrupt their plays. Traps are purple, and will have a symbol in the corner for anything other than Normal Traps. All Trap cards must be Set (placed face-down in a S/T Zone) before they can be used, and they can be activated during either player's turn. 
                            </p>
                        </div>
                        <h3>Types of Trap Cards</h3>
                        <ul>
                            <li>Normal Traps can be flipped face-up when you want to use them, and when any activation requirements are met. After they resolve, they go to the graveyard.</li>
                            <li>Continuous Traps are indicated by the same ∞ symbol as Continuous Spells and function the same way.</li>
                            <li>Counter Trap Cards are indicated by an arrow. They act like Normal Traps, but the only cards that can be activated in response to them are other Counter Trap Cards.</li>
                        </ul>
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