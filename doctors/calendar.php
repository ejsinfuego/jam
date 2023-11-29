<?php 

$title = 'Book Appointment';

require '../vendor/autoload.php';

use Carbon\Carbon;

$today = Carbon::today('Asia/Kolkata');

include(__DIR__ . '/../_header_v2.php');

if(isset($_GET['month'])){
    if($_GET['month'] == 'back'){
        $today = Carbon::today('Asia/Kolkata');
    }elseif($_GET['month'] == 'next'){
        $today = Carbon::today('Asia/Kolkata')->addMonth();
    }
}


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
    $days[] = $firstDay->copy()->addDay($i - 1)->format('d');
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
<div class="col-2"></div>
<div class="col-8" style="font-family: Alexandria, sans-serif; color: #6c757d; margin-bottom: 20px;">
<h2 class="d-lg-flex" style="font-family: Alexandria, sans-serif; color: #6c757d; margin-bottom: 20px;">Calendar of Scheduled Appointment</h2>
<p class="ms-5 ps-4">Click the dates of the calendar to book an appointment</p><small style="margin-left: 160px;" class="text-center">Approved appointments goes in here. </small>
<div class="container ms-5 ps-5">
        <div class="d-xxl-flex">
        <div class="row d-flex d-xxl-flex align-content-center align-self-center flex-wrap" style="font-family: Alexandria, sans-serif;">
            <div class="d-flex flex-wrap">
            <div class="col-7" style="background: #1abc9c;color: #f1f0f0;">
                <h1 class="text-center" style="font-family: Alexandria, sans-serif;"><a href="calendar.php?month=back" style="font-size: 25px; color: white; "><small><i><<</i></small></a><?php echo $today->format('F Y') ?><a href="calendar.php?month=next" style="color: white; font-size: 25px; "><small><i>>></i></small></a></h1>
            </div>
            <!-- <div class="col-5"></div>
                <?php foreach ($daysOfWeek as $dayOfWeek) : ?>
                <div class="col-md-3 col-lg-1 flex-wrap" style="border: 1.4px none #1abc9c;border-top-style: none;border-top-color: var(--bs-gray-500);border-right-style: solid;border-right-color: var(--bs-primary-border-subtle);border-bottom-style: solid;border-bottom-color: var(--bs-primary-border-subtle);border-left-style: solid;border-left-color: var(--bs-primary-border-subtle);color: var(--bs-gray-600);">
                    <h5 class="text-start d-xxl-flex flex-column align-content-center align-self-center flex-wrap justify-content-xxl-center pt-lg-0" style="font-size: 11px;margin-top: 11px;color: #6c757d;padding-left: 0px;margin-left: -4px;"><?php echo $dayOfWeek; ?></h5>
                </div>
                <?php endforeach; ?>
            </div> -->
            <div class="d-flex d-xxl-flex flex-wrap">
            <?php foreach ($days as $day) :?>
            <?php if ($day == 8 or $day == 15 or $day == 22 or $day == 29) : ?>
            <div class="d-flex flex-wrap w-100"></div>
            <?php endif; ?>
            <a class="appointmentDate col-md-3 col-lg-1 col-xxl-1 d-flex justify-content-lg-start flex-column" style="border: 1.4px none #1abc9c;border-top-style: none;border-top-color: var(--bs-gray-500);border-right-style: solid;border-right-color: var(--bs-primary-border-subtle);border-bottom-style: solid;border-bottom-color: var(--bs-primary-border-subtle);border-left-style: solid;border-left-color: var(--bs-primary-border-subtle);color: var(--bs-gray-600); cursor: pointer">
                    <h5 class="text-start d-xxl-flex flex-row align-content-center align-self-center flex-wrap pt-lg-0" style="font-size: 11px;margin-top: 11px;color: #6c757d;padding-left: 0px;margin-left: -4px;width: 100%;"><?php echo $day; ?></h5>
                    <h5 class="text-start d-xxl-flex flex-row align-content-center align-self-center flex-wrap pt-lg-0 pt-xxl-0" style="font-size: 11px;color: white; padding-left: 0px;margin-left: -4px;width: auto;margin-top: -2px; background-color:#1abc9c;">
                    <?php foreach ($available as $availableDates) : ?>
                    <?php echo (($availableDates['appointmentDate'] == $today->format('Y-m-').$day)) ? date('h:ia', strtotime($availableDates['appointmentTime'])) : '';?>
                    <?php endforeach; ?>
                </h5>
            </a>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
</div>
<div class="col-2"></div>
<?php include(__DIR__ . '/../_footer.php'); ?>