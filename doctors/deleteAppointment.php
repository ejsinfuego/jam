<?php
    include('../connection.php');
    session_start();
    //delete all picked appointments
    if(isset($_GET['appointment_id'])){
        $appointment_id = $_GET['appointment_id'];
            $database->query("DELETE FROM appointments WHERE id = '$appointment_id'");
    }
    $_SESSION['message'] = "Appointment deleted successfully.";
    $_SESSION['show_modal'] = "myModal";

    // header('location: appointments.php');
    //uncommentable if ideal way works.
    //sessions are not saved when rerouted. I don't know why but this is the work around.