<?php 

// Path: patient/addFeedback.php

require '../vendor/autoload.php';


include('../connection.php');
session_start();

use Carbon\Carbon;

$today = Carbon::now()->toDateString();

if($_POST){
    $feedback = $_POST['feedback'];
    $updated_at = $today;
    $id = $_POST['feedBackID'];

   $database->query('update appointments set feedback = "'.$feedback.'", updated_at = "'.$updated_at.'" where id = "'.$id.'"');

   $_SESSION['message'] = "Thank you for your feedback!";
    $_SESSION['show_modal'] = 'myModal';
    header('location: ../patient/appointments.php');

}