<?php

include('../connection.php');
session_start();
// Check if the form has been submitted
if(isset($_POST)){
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];
    $userid = $_POST['id'];
    var_dump($_POST);
    $patient = $database->query("SELECT * FROM patient WHERE id = '$userid'");
    $patient = $patient->fetch_assoc();

    if($oldPassword == $patient['password']){
        if($newPassword == $confirmPassword){
            $database->query("UPDATE patient SET password = '$newPassword' WHERE id = '$userid'");
            $message = 'Password was changed.';
           
        }else{
            $message = 'New password and confirm password does not match.';
            $_SESSION['show_modal'] = "myModal";
            header('location: profile.php?id='.$userid);
        }
    }else{
        $message= 'Old password is incorrect.';
        $_SESSION['show_modal'] = "myModal";
        header('location: profile.php?id='.$userid);
    }

}

$_SESSION['message'] = $message;
$_SESSION['show_modal'] = "myModal";
header('location: profile.php?id='.$userid);

