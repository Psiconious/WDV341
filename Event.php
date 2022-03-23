<?php
class Event implements \JsonSerializable{

    //description
    //properties
    //constructor method
    //setter/getters methods
    //processing methods

    //Class used for formatting/storing Event data from the database
    // 3/8/2022

    //Properties of the class
    private $eventName;
    private $eventDescription;

    //Constuctor method

    //Setter/Getters Methods
    public function setEventName($eventName){
        $this->eventName = $eventName;
    }

    public function setEventDescription($eventDescription){
        $this->eventDescription = $eventDescription;
    }

    public function getEventName(){
        return $this->eventName;
    }

    public function getEventDescription(){
        return $this->eventDescription;
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
    }
}
?>