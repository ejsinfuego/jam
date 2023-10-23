<?php
require '../vendor/autoload.php';

use Carbon\Carbon;

$today = Carbon::now();

include('../connection.php');
session_start();

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $cancel_details = $_POST['cancel_details'];
    
    //write query that cancels the appointment
    $database->query('update appointments set cancel_details="'.$cancel_details.'", updated_at="'.$today.'" where id='.$_POST['id']);
    
    $_SESSION['show_modal'] = 'myModal';
    $_SESSION['message'] = "Appointment cancelled successfully.";
     // header('location: appointments.php');
    //uncommentable if ideal way works.
    //sessions are not save when rerouted. I don't know why but this is the work around.
    
} else {
    $_SESSION['message'] = "Appointment cancelled successfully.";
    $_SESSION['show_modal'] = 'myModal';
     // header('location: appointments.php');
    //uncommentable if ideal way works.
    //sessions are not save when rerouted. I don't know why but this is the work around.
    
   
};
