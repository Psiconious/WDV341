<?php
    $eventID = 1;

    //connect to the database
    include 'dbConnect.php';

    //SQL command
    $SQL = "SELECT name,description FROM wdv341_events WHERE id = :eventID";

    //prepare statement
    $stmt = $conn->prepare($SQL);

    $stmt->bindParam(':eventID',$eventID);

    //execute
    $stmt->execute();

    //setting fetch mode to php assoicate array
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    $row=$stmt->fetch();

    echo $row['name'];
    echo $row['description'];

    $eventObj = new stdClass();

    $eventObj->eventName = $row['name'];
    $eventObj->eventDescription = $row['description'];

    $eventJson = json_encode($eventObj);
    
    echo '<p>';
    echo $eventJson;
    echo '</p>';

?>