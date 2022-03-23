<?php

    include 'Event.php';

    //connect to the database
    include 'dbConnect.php';

    //SQL command
    $SQL  = "SELECT name,description FROM wdv341_events";

    
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

    $row = $stmt->fetch();

    $eventObject = new Event();

    $eventObject->setEventName($row['name']);
    $eventObject->setEventDescription($row['description']);

    $eventJSON = json_encode($eventObject);

    echo '<p>' . $eventJSON . '</p>';

?>