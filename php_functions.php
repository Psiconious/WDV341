<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--Name: Trever Cluney-->
</head>
<body>
    <?php
        function usaDateFormat($dateIn){
            echo "<p>USA Formatted date: " . date("m/d/Y", $dateIn) . "</p>";
        }

        function internationalDateFormat($dateIn){
            echo "<p>International Formatted date: " . date("d/m/Y", $dateIn) . "</p>";
        }

        function formatPhoneNumber($numberIn){
            echo "<p>Phone Number format: (" . substr((string)$numberIn,0,3) . ") " . substr((string)$numberIn,3,3) . "-" . substr((string)$numberIn,6,4) . "</p>";
        }

        function usaCurrencyFormat($moneyIn){
            echo "<p>USA Formatted Currency: $" . number_format($moneyIn,2) . "</p>";
        }

        function stringManipulation($stringIn){
            echo "<p>String length is: " . strlen((string)$stringIn) . "</p>";
            $manipulatedString = trim((string)$stringIn);
            $manipulatedString = strtolower($manipulatedString);
            $checkString = 'dmacc';
            if(strpos($manipulatedString,$checkString)){
                echo "<p>The input string <em>" . $manipulatedString . "</em> contains <em>" . $checkString . "</em></p>";
            } 
            else{
                echo "<p>The input string <em>" . $manipulatedString . "</em> does <strong>not</strong> contains <em>" . $checkString . "</em></p>";     
            }
        }

        $d=strtotime("today");

        usaDateFormat($d);

        internationalDateFormat($d);

        stringManipulation(" Hello Dmacc, I hope you are having a great day. ");

        stringManipulation("hi my name is trever.");

        formatPhoneNumber(1234567890);

        usaCurrencyFormat(12356);
    ?>
</body>
</html>