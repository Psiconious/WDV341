<?php
//This will test the Event Class and its properties/methods

include 'Event.php';

$newEventObject = new Event();

$newEventObject->setEventName('Hello');

echo $newEventObject->getEventName();
?>