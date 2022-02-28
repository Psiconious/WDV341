<?php
    if(isset($_POST['email']) && $_POST['email'] != ''){
        if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){

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
            $body .= "Contacted: " . $date ."\r\n";
            $body .= "Message: " . $message . "\r\n";
            $body = wordwrap($body,70);

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

            $contactBody = wordwrap($contactBody,70);
            
            mail($to,$messageSubject, $body, $header);
            mail($userEmail,$messageSubject,$contactBody,$contactHeader);

            echo $contactBody;

        }
    }
?>