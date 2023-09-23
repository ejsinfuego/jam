<?php 

include '../vendor/autoload.php';

use Carbon\Carbon;

$today = Carbon::now('Asia/Kolkata');

include('../connection.php');
session_start();

if($_GET){
    
    $database->query("update appointments set status='done', updated_at='$today' where id=".$_GET['id']);
    $_SESSION['message'] = 'Appointment was marked as done.';
    $_SESSION['show_modal'] = 'myModal';

}

