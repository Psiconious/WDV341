<?php

session_start();

if (isset($_SESSION['validUser'])) {
    $userName = $_SESSION['username'];
}

require 'php/page-handler.php';

if (isset($_POST['email']) && $_POST['email'] != '') {
    if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {

        $userName = $_POST['name'];
        $userEmail = $_POST['email'];
        $messageSubject = $_POST['subject'];
        $message = $_POST['message'];

        $to = "trever.cluney@trevercluney.com";
        $body = "";
        $header = 'From: <' . $userEmail . '>' . "\r\n";
        $date = date("m/d/Y");

        $body .= "From: " . $userName . "\r\n";
        $body .= "Email: " . $userEmail . "\r\n";
        $body .= "Contacted: " . $date . "\r\n";
        $body .= "Message: " . $message . "\r\n";
        $body = wordwrap($body, 70);

        $contactHeader = "MIME-Version: 1.0" . "\r\n";
        $contactHeader .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $contactHeader .= 'From: <' . $to . '>' . "\r\n";
        $contactHeader .= 'Cc: trever.cluney@trevercluney.com' . "\r\n";
        $contactBody = "
            <html>
            <head>
            <title>Response Email</title>
            <style>
            body{
                display:flex;
                justify-content:center;
                align-items:center;
                height:100vh;
                font-family:'Raleway', sans-serif;
                background-color:#627b8a;
            }
            .container{
                width:500px;
                box-shadow: 0 15px 35px rgba(50,50,93,.1),0 5px 15px rgba(0,0,0,.07);
                padding:2em;
                background-color:#fff;
            }
            </style>
            </head>
            <body>
            <div class=container>
            <p>Thank you " . $userName . " for reaching out to us.</p>
            <p>Your message \"" . $message . "\" was recieved on " . $date . "</p>
            <p>We will review your message and be in contact with you soon.</p>
            <p>Best Regards,</p>
            <p>Trever Cluney</p>
            </div>
            </body>
            </html>
            ";

        $contactBody = wordwrap($contactBody, 70);

        mail($to, $messageSubject, $body, $header);
        mail($userEmail, $messageSubject, $contactBody, $contactHeader);
        header('Location: index.php');
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="main.js"></script>
    <style>
        .form-body {
            display: flex;
            justify-content: space-evenly;
            width: 60%;
            min-height: 80vh;
            background-color: #f0f0f0;
            padding: 10px;
            box-sizing: border-box;
        }

        .form-body * {
            padding: 0;
            margin: 0;
        }

        .form-group {
            margin-bottom: 1.5em;
            transition: all .3s;
        }

        .form-label {
            color: var(--font-color);
            display: block;
        }

        .form-control {
            box-shadow: none;
            border-radius: 0;
            border-color: #ccc;
            border-style: none none solid none;
            width: 100%;
            font-size: 1.25em;
            transition: all .6s;
        }

        .form-control::placeholder {
            color: #aaa;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: var(--font-hover-color);
            outline: none;
        }

        .form-control:invalid:focus {
            border-color: red;
        }

        .form-control:valid:focus {
            border-color: green;
        }

        .form-tab {
            background: darkgray;
            width: 50%;
            text-align: center;
            box-sizing: border-box;
        }

        .form-tab input {
            display: none;
        }

        .form-tab label {
            display: block;
            padding: 2% 0;
        }

        .form-tab label.active {
            background-color: #f0f0f0;
        }

        .form-tab label:hover {
            background: gray;
        }
    </style>
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
                        <li><a href="contact_form.php" class="<?php active('contact_form.php'); ?>">Contact Us</a></li>
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
                    <form action="contact_form.php" method="POST" class="form">
                        <div class="form-group">
                            <label for="name" class="form-label">Your Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Jane Doe" tabindex="1" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="email" class="form-label">Your Email</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="jane@doe.com" tabindex="2" required>
                        </div>
                        <div class="form-group">
                            <label for="subject" class="form-label">Subject</label>
                            <select name="subject" class="form-control" id="subject" tabindex="3">
                                <option value="general">General</option>
                                <option value="request">Request</option>
                                <option value="help">Help</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" rows="5" cols="50" id="message" name="message" placeholder="Enter Message..." tabindex="4"></textarea>
                        </div>
                        <div>
                            <button type="submit" class="btn">Send Message!</button>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</body>

</html>