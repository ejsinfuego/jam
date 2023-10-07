
<?php 

session_start();
include('../connection.php');
include '../vendor/autoload.php';

use Carbon\Carbon;

$today = Carbon::now('Asia/Kolkata');

if($_SESSION['usertype'] != 'd'){
    header('location: ../something_went_wrong.php');
}
if($_POST){
    $service_name = $_POST['service_name'];
    $description = $_POST['description'];

    $addService = $database->query("
        INSERT INTO services (service, description, created_at)
        VALUES ('$service_name', '$description', '$today')");
    $_SESSION['message'] = 'Service was added.';
    header('location: services.php');
}


?>