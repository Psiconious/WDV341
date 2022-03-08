<?php
    //connect to the database
    include 'dbConnect.php';

    //SQL command
    $SQL  = "SELECT name,date FROM wdv341_events";

    
    try{
        //prepare statement
        $stmt = $conn->prepare($SQL);
        //execute
        $stmt->execute();
        //setting fetch mode to php assoicate array
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
    }
    catch(ValueError $e){
        echo "<p>Failure to prepare SQL query.</p>";
    }
    catch(PDOException $e){
        echo "<p>Failure to execute SQL query.</p>";
    }
    catch(Error $e){
        echo "<p>Error in processing SQL query.</p>";
    }
    
?>

<style>
    span{
        margin-right: 10px;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>WDV341 Intro PHP</h1>
    <h2>Unit-7 Select data</h2>
    <h3>Current Events</h3>
    <?php
    echo "<table border='1'>";
	echo "<tr><th>Event Name</th><th>Date of the event</th></tr>";
        try{
            while( $row=$stmt->fetch()){
                echo '<tr>';
            echo '<td>',$row['name'],'</td>';
            echo '<td>',$row['date'],'</td>';
            echo "</tr>";
            }
        }
        catch(Error $e){
            echo "<p>Unable to process table.</p>";
        }
    echo "</table>";
	echo "<p>&nbsp;</p>";
    ?>
</body>
</html>