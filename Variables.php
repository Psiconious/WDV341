<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Variables</title>
    <!--Name: Trever Cluney-->
    <?php
        $yourName = "Trever Cluney";
        $number1 = 10;
        $number2 = 5;
        $total = $number1 + $number2;
        $myArray = array("PHP", "HTML", "JavaScript")
    ?>
</head>

<body>
    <h1>Assignment: 3-1: PHP Basics</h1>
    <?php 
        echo "<h2>$yourName</h2>\n";
        echo "<p>$number1 + $number2 = $total</p>\n";
        echo "<script> const jsArray = [";
        foreach ($myArray as &$value){
            if($value != end($myArray))
                echo "\"$value\",";
            else
                echo "\"$value\"";
        }
        echo "];\n";
        echo "jsArray.forEach(element => document.write(\"<li>\" + element + \"</li>\"));</script>";
    ?>
</body>

</html>