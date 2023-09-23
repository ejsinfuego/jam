<?php 

include '../vendor/autoload.php';

use Carbon\Carbon;

$today = Carbon::now('Asia/Kolkata');

include('../connection.php');

if($_POST){

    //add records
    $appointment_id = $_POST['appointment_id'];
    $tooth_number = $_POST['tooth_number'];
    $tooth_name = $_POST['tooth_name'];


    $database->query("insert into tooth (appointment_id, tooth_number, tooth_name, created_at) values ('$appointment_id', '$tooth_number', '$tooth_name', '$today')");

    $tooth_id = $database->insert_id;

    $database->query("insert into records (tooth_id, appointment_id, created_at) values ('$tooth_id', '$appointment_id', '$today')");

    $database->query("update appointments set status='done', updated_at='$today' where id=".$_POST['appointment_id']);

    $_SESSION['message'] = 'Records was added.';
    $_SERVER['show_modal'] = 'myModal';
    header('location: appointments.php');
}