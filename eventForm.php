<?php
if (isset($_POST['submit'])  && $_POST['email'] == '') {
    echo "<h1>Form submitted successfully</h1>";

    $eventname = $_POST['name'];
    $eventdescription = $_POST['description'];
    $eventpresenter = $_POST['presenter'];
    $date = date('Y-m-d');
    $eventdate = $_POST['date'];
    $eventtime = $_POST['time'];

    //connect to the database
    require "dbConnect.php";

    //prepare statement
    $sql = "INSERT INTO wdv341_events (name, description, presenter, date_inserted, date_updated, date, time) VALUES (:event_name, :event_description, :event_presenter, :event_inserted, :event_updated, :event_date, :event_time)";

    $stmt = $conn->prepare($sql);

    //bind parameters
    $stmt->bindParam(':event_name', $eventname);
    $stmt->bindParam(':event_description', $eventdescription);
    $stmt->bindParam(':event_presenter', $eventpresenter);
    $stmt->bindParam(':event_inserted', $date);
    $stmt->bindParam(':event_updated', $date);
    $stmt->bindParam(':event_date', $eventdate);
    $stmt->bindParam(':event_time', $eventtime);

    //execute
    $stmt->execute();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Self Posting Insert Form</title>
    <style>
        .email{
            display: none;
        }
    </style>
</head>

<body>
<?php
if(!isset($_POST['submit'])){
?>
    <form action="eventForm.php" method="post">
        <p>
            <label for="name">
                Event Name:
            </label>
            <input type="text" name="name" id="name">
        </p>
        <p>
            <label for="description">
                Event Description:
            </label>
            <textarea name="description" id="description" cols="30" rows="10"></textarea>
        </p>
        <p>
            <label for="presenter">
                Presenter:
            </label>
            <input type="text" name="presenter" id="presenter">
        </p>
        <p>
            <input type="text" name="email" class="email">
        </p>
        <p>
            <label for="date">Select a date: </label>
            <input type="date" name="date" id="date">
            <label for="time">Select a time:</label>
            <input type="time" name="time" id="time">
        </p>
        <p>
            <input type="submit" value="submit" name="submit" >
            <input type="reset" value="reset">
        </p>
    </form>
<?php
}
?>
</body>

</html>