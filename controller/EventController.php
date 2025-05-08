<?php
session_start();

$event = new EventController();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["create"])) {
        $event->CreateEvent();
    } elseif (isset($_POST["read"])) {
        $event->ReadEvent();
    } elseif (isset($_POST["update"])) {
        $event->UpdateEvent();
    } elseif (isset($_POST["delete"])) {
        $event->DeleteEvent();
    } 
}

class EventController
{
    function CreateEvent(){
        echo "<p>Create Event</p>";
    }
    function ReadEvent(){
        echo "<p>Read Event</p>";
    }
    function UpdateEvent(){
        echo "<p>Update Event</p>";
    }
    function DeleteEvent(){
        echo "<p>Delete Event</p>";
    }

    
    function conn()
    {
        $dbname="firalia";
        $servername = "localhost";
        $username = "username";
        $password = "password";

        try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Connected successfully";
        } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        }
        return $conn;
    }


}