<?php


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    if(isset($_POST["submit"])){
        echo "<h1>Form submitted successfully</h1>";
        $eventusername = $_POST['username'];
        $eventpassword = $_POST['password'];

        //connect to the database
        require "dbConnect.php";

        //prepare statement
        $sql = "SELECT count(*) FROM event_user WHERE event_user_name = :user AND event_user_password = :pass";

        $stmt = $conn->prepare($sql);

        //bind parameters
        $stmt->bindParam(':user',$eventusername);
        $stmt->bindParam(':pass', $eventpassword);

        //execute
        $stmt->execute();

        $rowCount = $stmt->fetchColumn();

        echo "<h2>$rowCount, $eventusername, $eventpassword</h2>";
    }
    else{

    ?>
    <h1>Please Login</h1>

    <form method="POST" action="login.php">
        <p>
            <label for="username">Username: </label>
            <input type="text" name="username" id="username" placeholder="Username">
        </p>
        <P>
            <label for="password">Password: </label>
            <input type="text" name="password" id="password">
        </P>
        <p>
            <input type="submit" value="Sign On" name="submit" id="submit">
            <input type="reset">
        </p>
    </form>
<?php
    }
?>
</body>
</html>