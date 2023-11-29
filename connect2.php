<?php

    $database= new mysqli("sql104.infinityfree.com","if0_35419861","VakrXyDKRZf5Jn","if0_35419861_dental");
    if ($database->connect_error){
        die("Connection failed:  ".$database->connect_error);
    }

?>