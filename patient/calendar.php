<?php 

$title = 'Book Appointment';

require '../vendor/autoload.php';

use Carbon\Carbon;

$today = Carbon::today();

include(__DIR__ . '/../_header_v2.php'); 

$available = $database->query('select appointmentDate, appointmentTime from appointments where cancel_details = "";');
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
<div class="container d-flex flex-column justify-content-center justify-content-xxl-center align-items-xxl-center">
    <div class="row d-md-flex d-lg-flex justify-content-md-center justify-content-lg-center">
            <div class="col-md-12 d-md-flex d-xxl-flex justify-content-center align-items-center align-content-center justify-content-xxl-center" style="background: #1abc9c;color: #f1f0f0;width: 560px;">
                <h1 class="text-center" style="font-family: Alexandria, sans-serif;"><?php echo $today->format('F Y'); ?></h1>
            </div>
        </div>
            <div class="row d-flex d-xxl-flex justify-content-center align-content-center align-self-center flex-nowrap" style="font-family: Alexandria, sans-serif;width: 560px; border-radius: 6px;">
                <?php foreach ($daysOfWeek as $dayOfWeek) : ?>
                <div class="col-md-3 col-lg-1 col-xxl-1 d-xxl-flex align-content-center justify-content-xxl-center me-lg-0" style="border: 1.4px none #1abc9c;border-top-style: none;border-top-color: var(--bs-gray-500);border-right-style: solid;border-right-color: var(--bs-primary-border-subtle);border-bottom-style: solid;border-bottom-color: var(--bs-primary-border-subtle);border-left-style: solid;border-left-color: var(--bs-primary-border-subtle);color: var(--bs-gray-600);width: 80px; border-radius: 6px;">
                    <h5 class="text-start d-xxl-flex flex-column align-content-center align-self-center flex-wrap justify-content-xxl-center pt-lg-0" style="font-size: 11px;margin-top: 11px;color: #6c757d;padding-left: 0px;margin-left: -4px; border-radius: 6px;"><?php echo $dayOfWeek; ?></h5>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="row d-flex d-xxl-flex justify-content-start align-content-center align-self-center flex-wrap" style="font-family: Alexandria, sans-serif;width: 560px;">
                <?php foreach ($days as $day) : ?>
                <div class="col-md-3 col-lg-1 col-xxl-1 d-xxl-flex flex-column align-content-center justify-content-xxl-center me-lg-0" style="border: 1.4px none #1abc9c;border-top-style: none;border-top-color: var(--bs-gray-500);border-right-style: solid;border-right-color: var(--bs-primary-border-subtle);border-bottom-style: solid;border-bottom-color: var(--bs-primary-border-subtle);border-left-style: solid;border-left-color: var(--bs-primary-border-subtle);color: var(--bs-gray-600);width: 80px; border-radius: 6px;">
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
                    <section class="position-relative py-4 py-xl-5">
                        <div class="container position-relative">
                            <div class="row d-flex justify-content-center" style="margin-top: -14px;">
                                <div class="col-md-8 col-lg-11 col-xl-5 col-xxl-6">
                                    <div class="card mb-5">
                                        <div class="card-body p-sm-5" style="font-family: Alexandria, sans-serif;box-shadow: 3px 3px var(--bs-primary-border-subtle);border-radius: 6px;">
                                            <h2 class="text-center mb-4" style="color: #6c757d;">Book an appointment</h2>
                                            <h6 class="text-center mb-4">Check the calendar above to check the available dates for this month.</h6>
                                            <form method="post" action="submitConsultation.php">
                                                <div class="mb-3"><label class="form-label">Date</label>
                                                <input class="form-control" id="name-2" name="date" placeholder="Date" type="date" min="<?php echo $today->toDateString(); ?>"><label class="form-label" style="padding-top: 0px;margin-top: 8px;">Time</label>
                                                <input class="form-control" id="name-1" name="time" placeholder="Name" type="time" min="09:00" max="18:00"></div>
                                                <label class="form-label">Type</label>
                                                <div class="dropdown bg-light-subtle d-flex justify-content-xxl-start text-align-left" style="width: auto;">
                                                <select class="btn dropdown-toggle" aria-expanded="false" data-bs-toggle="dropdown" name="type" type="button">
                                                <div class="dropdown-menu text-align-left">
                                                <?php foreach($services as $availableServices) : ?>
                                                <option class="dropdown-item text-align-left" value="<?php echo $availableServices['id']; ?>"><?php echo $availableServices['service']; ?></option>
                                                <?php endforeach; ?>
                                                </div>
                                                </select>
                                                <input type="hidden" value="<?php echo $userid; ?>" name="patient_id">
                                                </div>
                                                <div class="mb-3"></div>
                                                <div><button class="btn btn-primary d-block w-100" type="submit">Book</button></div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
 <?php include_once(__DIR__ . '/../_footer.php'); ?>