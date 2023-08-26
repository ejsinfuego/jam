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

// Get the day of the weeks
$daysOfWeek = [];

$firstDay->startOfMonth(); // Reset $firstDay to the start of the month

for ($i = 0; $i < 7; $i++) {
    $daysOfWeek[] = $firstDay->addDay()->format('D');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Availability Calendar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <style>
    /* Add custom styling here */
    .calendar {
      border: 1px solid #ccc;
      padding: 10px;
      margin: 20px;
      max-width: 400px;
      margin: 0 auto;
    }
    .calendar .day {
      border: 1px solid #ccc;
      padding: 10px;
      text-align: center;
      cursor: pointer;
    }
    .calendar .day.disabled {
      background-color: #f5f5f5;
      cursor: not-allowed;
    }
    .calendar .day.selected {
      background-color: #007bff;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="calendar">
    <div class="month">
      <h2 class="text-center"><?php echo $today->format('F Y'); ?></h2>
    </div>
    <div class="days">
      <div class="row">
        <?php foreach ($daysOfWeek as $day) : ?>
          <div class="col day"><?php echo $day; ?></div>
        <?php endforeach; ?>
      </div>
      <div class="day">
        <div class="row">
          <?php foreach ($days as $day) : ?>
            <div class="col day"><?php echo $day; ?></div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
  
</body>
</html>
