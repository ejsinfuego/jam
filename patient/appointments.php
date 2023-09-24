<?php 
$title = "Check Appointment";
include(__DIR__ . '/../_header_v2.php');



//query that also gets the first and last name of the patient and inner join it in appointments table

$result = $database->query("SELECT appointments.id, appointments.appointmentDate, appointments.appointmentTime, appointments.service_id, appointments.cancel_details, appointments.status, appointments.resched_details, appointments.created_at, patient.first_name, patient.last_name, services.service FROM appointments INNER JOIN patient ON appointments.patient_id = patient.id INNER JOIN services ON appointments.service_id = services.id WHERE appointments.patient_id = '$userid';");

//get all the appointments of patient by 10
if($result->num_rows>0){
    $appointments = $result->fetch_all(MYSQLI_ASSOC);
}else{
    $appointments = [];
}

$services = $database->query('select * from services');

?>
<script>
    function editAppointment(appointment_id, appointmentDate){
        $('#editAppointment').modal('show');
        $('#currentDate').html(appointment_id);
        $("#appointment_id").val(appointment_id);

    };

    function submitFeedback(id){
        $('#submitFeedback').modal('show');
        $("#feedBackID").val(id);

    };

</script>
<!-- modal to edit appointment -->
<div id="editAppointment" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                        <div class="card-body p-sm-5" style="font-family: Alexandria, sans-serif;box-shadow: 3px 3px var(--bs-primary-border-subtle);border-radius: 6px;">
                                            <h2 class="text-center mb-4" style="color: #6c757d;">Edit Scheduled Appointment</h2>
                                            <h6 class="text-center mb-4" style="font-family: Alexandria, sans-serif;color: #6c757d;margin: -19px;">Click the information to edit.</h6>
                                            <form class="form" method="post" action="editAppointment.php">
                                                <label for="date">New Date:</label>
                                                <input class="form-control" name="date" type="date">
                                                <input type="hidden" name="id" id="appointment_id">
                                                <label for="time">New Time:</label>
                                                <input class="form-control" name="time" type="time">
                                                <label for="service_id">Service</label>
                                                <select class="form-control" name="service_id">
                                                    <?php foreach($services as $service) :?>
                                                        <option value="<?php echo $service['id']; ?>">
                                                        <?php echo $service['service']; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="pt-3">
                                                    <button class="btn btn-outline-primary type="submit">Save
                                                        
                                                    </button>
                                                </div>
                                            </form>
                                 </div>
    
                        </div>
                    </div>
                </div>
</div>
<!-- end modal -->
<!-- modal for submit feedback -->
<div id="submitFeedback" class="modal fade" role="dialog" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                        <div class="card-body p-sm-5" style="font-family: Alexandria, sans-serif;box-shadow: 3px 3px var(--bs-primary-border-subtle);border-radius: 6px;">
                                            <h2 class="text-center mb-4" style="color: #6c757d;">Submit Feedback</h2>
                                            <h6 class="text-center mb-4" style="font-family: Alexandria, sans-serif;color: #6c757d;margin: -19px;">We value what your </h6>
                                            <form method="post" action="addFeedback.php">
                                                <label for="feedback">Feedback</label>
                                                <textarea class="form-control" name="feedback"></textarea>
                                                <input type="hidden" id="feedBackID" name="feedBackID">
                                                <div class="pt-3">
                                                    <button class="btn btn-sm btn-outline-info type="submit">Submit
                                                    </button>
                                                </div>
                                            </form>
                                </div>
    
                        </div>
                    </div>
                </div>
</div>
<!-- end modal -->
        <div class="col">
        <h2 class="d-lg-flex justify-content-lg-center" style="font-family: Alexandria, sans-serif;margin-bottom: 20px;margin-top: 20px;text-shadow: 3px 2px #abb2b9;">Appointments</h2>
                <div class="table-responsive" style="font-family: Alexandria, sans-serif;">
                    <table id="sortTable" class="table table-striped table-striped-columns table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Booked Date</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <!-- This scripts loops and get all the appointments of the patient -->
                        <?php foreach($appointments as $appointment): ?>
                            <tr>
                                <td><?php echo $appointment['first_name']." ".$appointment['last_name'] ?></td>
                                <form class="d-flex justify-content-center flex-wrap my-2" method="post" action="deleteAppointment.php">
                                <td><?php echo $appointment['service'];?></td>
                                <td>
                                    <?php echo ($appointment['resched_details'] != null) ? date('M-d-Y', strtotime($appointment['resched_details'])): date('M-d-Y', strtotime($appointment['appointmentDate'])); ?>
                                </td>
                                <td><?php echo date('h:i A', strtotime($appointment['appointmentTime'])); ?></td>
                                <td><?php echo date('m-d-y h:i A', strtotime($appointment['created_at'])); ?></td>
                                <td>
                                <?php echo ($appointment['cancel_details'] != null) ?'<a class="text-danger" style="cursor: pointer;">Cancelled</a>' : (($appointment['status'] == '') 
                                ? 'Pending' 
                                : (($appointment['status'] == 'done') ? '<p class="text-success" style="margin-bottom: -10px;">'.ucfirst($appointment['status']).'<p>' :'<p class="text-info" style="margin-bottom: -10px;">'.ucfirst($appointment['status'].'<p>')))
                                ; 
                                ?>
                                </td>
                                <td class="d-lg-flex">

                                <?php if($appointment['status'] == 'approved' and $appointment['status'] != 'done' or $appointment['status'] == null) : ?>
                                    <button onclick="editAppointment(<?php echo $appointment['id']; ?>)" class="btn btn-primary btn-sm" type="button" style="background: #2ecc71;border-style: none;">Edit</button>
                                <?php endif; ?>
                                <?php if($appointment['cancel_details'] == null and $appointment['status'] != 'done') : ?>
                                    <button class="cancelButton btn btn-outline-danger btn-sm" type="button" style="border-style: none; margin-left: 10px;">Cancel</button>
                                    <input type="hidden" name="appointment_id" value="<?php echo $appointment['id']; ?>">
                                <?php else: ?>
                                    <button onclick="submitFeedback(<?php echo $appointment['id']; ?>)" class="btn btn-outline-info btn-sm" type="button" style="border-style: none; margin-left: 10px;">Feedback</button>
                                <?php endif; ?>
                                    <div id="cancelModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <p>We will be glad to know why you will cancel.</p>
                                                    <label for="cancel_details">Reason for cancellation :</label>
                                                    <textarea type="text" name="cancel_details" id="cancel_details" class="form-control">
                                                    </textarea>
                                                </div>
                                                    <div class="modal-footer">

                                                        <button onclick="cancelAppointment(<?php echo $appointment['id']; ?>)" class="btn btn-danger btn-sm" type="button" style="border-style: none; margin-left: 10px;">Submit</button>
                                                        <button class="btn btn-secondary btn-sm" type="button" style="border-style: none; margin-left: 10px;" data-bs-dismiss="modal">Close</button>

                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>    
                </div>
            </div>
<?php include('../_footer.php');