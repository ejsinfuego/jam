<?php 

include '../vendor/autoload.php';
use Carbon\Carbon;
$today = Carbon::now('Asia/Kolkata');

include('../connection.php');
session_start();

function normalize_submitted_data(
    array $submittedData,
    array $files
): array {
    $normalizedData = [
        'destination' =>
            isset($submittedData['destination'])
                ? (string)$submittedData['destination']
                : '',
        'number_of_tickets_available' =>
            isset($submittedData['number_of_tickets_available'])
                ? (int)$submittedData['number_of_tickets_available']
                : 0,
        'is_accessible' =>
            isset($submittedData['is_accessible'])
                ? true
                : false
    ];

    if (
        isset($files['picture']['error'])
        && $files['picture']['error'] === UPLOAD_ERR_OK
    ) {
        $normalizedData['picture'] = $files['picture']['tmp_name'];
    }

    return $normalizedData;
}

if($_POST){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $start = $_POST['start'];
    $end = $_POST['end'];
    $file = $_FILES['file'];

    $tday = $today->toDateString();

    //image upload and normalized data
    $normalized = normalize_submitted_data($_POST, $_FILES);

    

    $_SESSION['message'] = 'Events added Succesfully';
    $_SESSION['show_modal'] = 'myModal';
    header('location: events.php');
}
