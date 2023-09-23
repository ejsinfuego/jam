<?php 
//script to approve appointment
//include the database connection
include('../connection.php');
session_start();

require '../vendor/autoload.php';
use Carbon\Carbon;


//get the id of the appointment
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $timenow = Carbon::now();
        $database->query("UPDATE appointments SET updated_at = '$timenow', status = 'Approved' WHERE id = '$id';");
    }
   
    $_SESSION['message'] = "Appointment(s) approved.";
    $_SESSION['show_modal'] = "myModal";
    //header("location: appointments.php")
    //sessions are not being recorded if rerouted."    