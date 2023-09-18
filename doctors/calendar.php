<?php 

$title = 'Book Appointment';

require '../vendor/autoload.php';

use Carbon\Carbon;

$today = Carbon::today();

include(__DIR__ . '/../_header_v2.php'); 

$available = $database->query('select appointmentDate, appointmentTime from appointments where cancel_details = ""');
$availableDates = $available->fetch_assoc();


$dateTaken = Carbon::today();
$timeTaken = Carbon::today();
$date = date_format($dateTaken, "j");
$time = date_format($timeTaken, "h:sa");


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

$services = $database->query("select id, service from services;");
$availableServices = $services->fetch_assoc();


?>
<div class="col">
<h2 class="d-lg-flex justify-content-lg-center" style="font-family: Alexandria, sans-serif; color: #6c757d; margin-bottom: 20px;">Calendar of Scheduled Appointment</h2>
<div class="container d-flex align-items-center">
        <div class="d-xxl-flex justify-content-center">
        <div class="row d-flex d-xxl-flex justify-content-start align-content-center align-self-center flex-wrap" style="font-family: Alexandria, sans-serif;">
            <div class="d-flex flex-wrap">
            <div class="col-7 justify-content-center" style="background: #1abc9c;color: #f1f0f0;">
                <h1 class="text-center" style="font-family: Alexandria, sans-serif;"><?php echo $today->format('F Y') ?></h1>
            </div>
            <div class="col-5"></div>
                <?php foreach ($daysOfWeek as $dayOfWeek) : ?>
                <div class="col-md-3 col-lg-1 flex-wrap" style="border: 1.4px none #1abc9c;border-top-style: none;border-top-color: var(--bs-gray-500);border-right-style: solid;border-right-color: var(--bs-primary-border-subtle);border-bottom-style: solid;border-bottom-color: var(--bs-primary-border-subtle);border-left-style: solid;border-left-color: var(--bs-primary-border-subtle);color: var(--bs-gray-600);">
                    <h5 class="text-start d-xxl-flex flex-column align-content-center align-self-center flex-wrap justify-content-xxl-center pt-lg-0" style="font-size: 11px;margin-top: 11px;color: #6c757d;padding-left: 0px;margin-left: -4px;"><?php echo $dayOfWeek; ?></h5>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="d-flex flex-wrap">
            <?php foreach ($days as $day) :?>
            <?php if ($day == 8 or $day == 15 or $day == 22 or $day == 29) : ?>
            <div class="d-flex w-100"></div>
            <?php endif; ?>
            <div class="col-md-3 col-lg-1 col-xxl-1 d-xxl-flex flex-column align-content-center justify-content-xxl-center me-lg-0" style="border: 1.4px none #1abc9c;border-top-style: none;border-top-color: var(--bs-gray-500);border-right-style: solid;border-right-color: var(--bs-primary-border-subtle);border-bottom-style: solid;border-bottom-color: var(--bs-primary-border-subtle);border-left-style: solid;border-left-color: var(--bs-primary-border-subtle);color: var(--bs-gray-600);">
                    <h5 class="text-start d-xxl-flex flex-row align-content-center align-self-center flex-wrap pt-lg-0" style="font-size: 11px;margin-top: 11px;color: #6c757d;padding-left: 0px;margin-left: -4px;width: 100%;"><?php echo $day; ?></h5>
                    <h5 class="text-start d-xxl-flex flex-row align-content-center align-self-center flex-wrap pt-lg-0 pt-xxl-0" style="font-size: 11px;color: white; padding-left: 0px;margin-left: -4px;width: 100%;margin-top: -2px; background-color:#1abc9c;">
                    <?php foreach ($available as $availableDates) : ?>
                    <?php if ($availableDates['appointmentDate'] == $today->format('Y-m-') . $day) : ?>
                    <?php echo date('h:ia', strtotime($availableDates['appointmentTime'])); ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </h5>
            </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php include(__DIR__ . '/../_footer.php'); ?>