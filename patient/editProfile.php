<?php

include '../vendor/autoload.php';

use Carbon\Carbon;

$today = Carbon::now('Asia/Kolkata');

include('../connection.php');
session_start();

if($_POST){


     $fieldsToUpdate = array();

     // Check if each field is set and not empty, and add it to the array if it is
     if(isset($_POST['first_name']) && !empty($_POST['first_name'])){
         $fieldsToUpdate['first_name'] = $_POST['first_name'];
     }
     if(isset($_POST['last_name']) && !empty($_POST['last_name'])){
         $fieldsToUpdate['last_name'] = $_POST['last_name'];
     }
     if(isset($_POST['email']) && !empty($_POST['email'])){
         $fieldsToUpdate['email'] = $_POST['email'];
     }
     if(isset($_POST['contact_number']) && !empty($_POST['contact_number'])){
         $fieldsToUpdate['contact_number'] = $_POST['contact_number'];
     }
     if(isset($_POST['dob']) && !empty($_POST['dob'])){
        $fieldsToUpdate['dob'] = $_POST['dob'];
    }
     if(isset($_POST['sex']) && !empty($_POST['sex'])){
         $fieldsToUpdate['sex'] = $_POST['sex'];
     }
     
     if(isset($_POST['address']) && !empty($_POST['address'])){
        $fieldsToUpdate['address'] = $_POST['address'];
    }
     // Check if there are any fields to update
     if(!empty($fieldsToUpdate)){
         // Build the SQL query to update the fields
         $query = 'UPDATE patient SET ';
         $params = array();
         foreach($fieldsToUpdate as $field => $value){
             $query .= $field . ' = ?, ';
             $params[] = $value;
         }
         $query .= 'updated_at = ? WHERE id = ?';
         $params[] = $today;
         $params[] = $_POST['id'];
 
         // Prepare and execute the query
         $stmt = $database->prepare($query);
         $stmt->execute($params);
         $_SESSION['show_modal'] = 'myModal';
         $_SESSION['message'] = 'Profile Updated Successfully';
        header('location: profile.php');
     }


}