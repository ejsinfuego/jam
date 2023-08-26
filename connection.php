<?php

    $database= new mysqli("localhost","root","","dental");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>