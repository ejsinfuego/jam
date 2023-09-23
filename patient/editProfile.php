<?php

include '../vendor/autoload.php';

use Carbon\Carbon;

$today = Carbon::now('Asia/Kolkata');

include('../connection.php');

if($_POST){
    $id = $_POST['id'];
    $fname = $_POST['first_name'];
    $lname = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $database->query("update appointments set resched_details='$date', appointmentTime='$time', service_id='$service', updated_at='$today' where id='$id'");
    $_SESSION['show_modal'] = 'myModal';
    $_SESSION['message'] = 'Appointment was updated.';
    header('location: appointments.php');
}