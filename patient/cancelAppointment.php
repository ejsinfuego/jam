<?php

session_start();

require '../vendor/autoload.php';

use Carbon\Carbon;

$today = Carbon::today();

include('../connection.php');

if(isset($_POST)){
    $id = $_POST['id'];
    $cancel_details = $_POST['cancel_details'];
    //write query that cancels the appointment
    $database->query('update appointments set cancel_details="'.$cancel_details.'", updated_at="'.$today.'" where id='.$_POST['id']);
    $_SESSION['message'] = 'Appointment was cancelled.';
    header('location: appointments.php');

}else{
    $_SESSION['last_page'] = 'patient/appointments.php';
    header('location: ../something_went_wrong.php');
}

?>
