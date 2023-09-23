<?php

include '../vendor/autoload.php';

use Carbon\Carbon;

$today = Carbon::now('Asia/Kolkata');

include('../connection.php');
session_start();

if($_POST){
    $id = $_POST['id'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $service = $_POST['service_id'];

    $database->query("update appointments set resched_details='$date', appointmentTime='$time', service_id='$service', updated_at='$today' where id='$id'");
    $_SESSION['show_modal'] = 'myModal';
    $_SESSION['message'] = 'Appointment was updated.';
    header('location: appointments.php');
}
