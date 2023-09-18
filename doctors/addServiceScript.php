
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
    $price = $_POST['price'];
    $description = $_POST['description'];

    $addService = $database->query("INSERT INTO services (service, price, description, created_at, updated_at) VALUES('$service_name', '$price', '$description', '$today', '$today')");
    $_SESSION['message'] = 'Service was added.';
    header('location: services.php');
}


?>