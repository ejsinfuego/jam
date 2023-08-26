<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Calendar</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alexandria&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alumni+Sans+Collegiate+One&amp;display=swap">
    <link rel="stylesheet" href="assets/css/bs-theme-overrides.css">
</head>

<?php
require 'vendor/autoload.php';

use Carbon\Carbon;

$today = Carbon::today();

$daysInMonth = $today->daysInMonth;

$firstDay = $today->copy()->startOfMonth(); // Clone the original $firstDay for reuse

// Get days in this month
$days = [];

for ($i = 1; $i <= $daysInMonth; $i++) {
    $days[] = $firstDay->copy()->addDay($i - 1)->format('j');
}

//get days of the week
$daysOfWeek = [
    'Sun',
    'Mon',
    'Tues',
    'Wed',
    'Thurs',
    'Fri',
    'Sat',
];

?>
<body>
    <div class="container d-flex flex-column justify-content-center justify-content-xxl-center align-items-xxl-center">
    <div class="row d-md-flex d-lg-flex justify-content-md-center justify-content-lg-center">
            <div class="col-md-12 d-md-flex d-xxl-flex justify-content-center align-items-center align-content-center justify-content-xxl-center" style="background: #1abc9c;color: #f1f0f0;width: 560px;">
                <h1 class="text-center" style="font-family: Alexandria, sans-serif;"><?php echo $today->format('F Y') ?></h1>
            </div>
        </div>
        <div class="row d-flex d-xxl-flex justify-content-center align-content-center align-self-center flex-nowrap" style="font-family: Alexandria, sans-serif;width: 560px;">
            <?php foreach ($daysOfWeek as $dayOfWeek) : ?>
            <div class="col-md-3 col-lg-1 col-xxl-1 d-xxl-flex align-content-center justify-content-xxl-center me-lg-0" style="border: 1.4px none #1abc9c;border-top-style: none;border-top-color: var(--bs-gray-500);border-right-style: solid;border-right-color: var(--bs-primary-border-subtle);border-bottom-style: solid;border-bottom-color: var(--bs-primary-border-subtle);border-left-style: solid;border-left-color: var(--bs-primary-border-subtle);color: var(--bs-gray-600);width: 80px;">
                <h5 class="text-start d-xxl-flex flex-column align-content-center align-self-center flex-wrap justify-content-xxl-center pt-lg-0" style="font-size: 11px;margin-top: 11px;color: #6c757d;padding-left: 0px;margin-left: -4px;"><?php echo $dayOfWeek; ?></h5>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="row d-flex d-xxl-flex justify-content-start align-content-center align-self-center flex-wrap" style="font-family: Alexandria, sans-serif;width: 560px;">
            <?php foreach ($days as $day) : ?>
            <div class="col-md-3 col-lg-1 col-xxl-1 d-xxl-flex flex-column align-content-center justify-content-xxl-center me-lg-0" style="border: 1.4px none #1abc9c;border-top-style: none;border-top-color: var(--bs-gray-500);border-right-style: solid;border-right-color: var(--bs-primary-border-subtle);border-bottom-style: solid;border-bottom-color: var(--bs-primary-border-subtle);border-left-style: solid;border-left-color: var(--bs-primary-border-subtle);color: var(--bs-gray-600);width: 80px;">
                <h5 class="text-start d-xxl-flex flex-row align-content-center align-self-center flex-wrap pt-lg-0" style="font-size: 11px;margin-top: 11px;color: #6c757d;padding-left: 0px;margin-left: -4px;width: 100%;"><?php echo $day; ?></h5>
                <h5 class="text-start d-xxl-flex flex-row align-content-center align-self-center flex-wrap pt-lg-0 pt-xxl-0" style="font-size: 11px;color: #6c757d;padding-left: 0px;margin-left: -4px;width: 100%;margin-top: -2px;">Event</h5>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>