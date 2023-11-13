<?php 
$title = "Check Appointment";
include(__DIR__ . '/../_header_v2.php');

if($_SESSION['usertype'] != 'd'){
    header('location: ../something_went_wrong.php');
}
$result = $database->query("SELECT appointments.id, appointments.appointmentDate, appointments.cancel_details,appointments.appointmentTime, appointments.status, appointments.service_id, appointments.created_at, appointments.updated_at, patient.first_name, patient.last_name, services.service FROM appointments INNER JOIN patient ON appointments.patient_id = patient.id INNER JOIN services ON appointments.service_id = services.id");


if($result->num_rows>0){
    $appointments = $result->fetch_all(MYSQLI_ASSOC);
}else{
    $appointments = [];
}
?>
<script>
        
        function approveAppointment(id){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200){
                window.location.reload();
            }
        };
            xhttp.open("GET", "approveAppointment.php?id="+id, true);
            xhttp.send();
        };

        function doneAppointment(id){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if(this.readyState == 4 && this.status == 200){
                window.location.reload();
            }
        }; 
            xhttp.open("GET", "doneAppointment.php?id="+id, true);
            xhttp.send();
        };

        function viewCancellation(cancel_details){
            $('#details').html(cancel_details);
            $('#cancelDetails').modal('show');
        };

        function addRecords(id){
            $('#doneDetails').modal('show');
            $('input[name="appointment_id"]').val(id);
        };

        function generateReport(id){
            $('input[name="appointment_id"]').val(id);
            window.location.href = "generateReport.php?id="+id;
        };
        
</script>
<style>
    .form-control{
        font-family: Inter, sans-serif;
    }
    td{
        font-family: Inter, sans-serif;
    }
</style>
                                    <!-- modal for done appointment records -->
                <div id="doneDetails" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="card-body p-sm-5" style="font-family: Alexandria, sans-serif;box-shadow: 3px 3px var(--bs-primary-border-subtle);border-radius: 6px;">
                                                <h2 class="text-center mb-4" style="color: #6c757d;">Add Records</h2>

                                                <form action="addRecords.php" method="post">
                                                    <label for="tooth_name">Tooth Name <i><small>(Left or Right Canine, Molar, Front tooth)</small></i></label>
                                                    <input type="text" name="tooth_name" class="form-control" placeholder="example: Left or Right Canine, Molar, Front tooth">
                                                    <label for="tooth_name">Number of Teeth Operated <i><small>(1,2,3,4,5)</small></i></label>
                                                    <input type="text" name="tooth_number" class="form-control" placeholder="1,2,3,4,5">
                                                    <input type="hidden" name="appointment_id">
                                                    <label for="tooth_name">Prescribe Medicine</label>
                                                    <textarea type="text" name="prescribemedicine" class="form-control" placeholder="Prescribe medicine for the patient. Separate each medicine by new line."></textarea>
                                                    <!-- button to generate report -->
                                                    
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
                                <th>Status</th>
                                <th>Date Booked</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            <!-- This the block where it displays all the appointments of all the patient -->
                            <?php foreach($appointments as $appointment) : ?>
                        <tr>
                                <td><?php echo $appointment['first_name']." ".$appointment['last_name'] ?></td>
                                <form class="d-flex justify-content-center flex-wrap my-2" method="post" action="deleteAppointment.php">
                                <td><?php echo $appointment['service'];?></td>
                                <td><?php echo date('M-d-Y', strtotime($appointment['appointmentDate'])); ?></td>
                                <td><?php echo date('h:i A', strtotime($appointment['appointmentTime'])); ?></td>
                                 <!-- This code below sets to have a function view cancel details if cancel details is not null -->
                            <td 
                            <?php if($appointment['cancel_details'] != null ){ ;?> onclick='viewCancellation(<?php echo json_encode($appointment['cancel_details']); ?>)' style="cursor: pointer;"
                               <?php  };?>
                               >
                                <!-- #region -->
                                <?php echo ($appointment['cancel_details'] != null) ?'<a class="text-danger" style="cursor: pointer;">Cancelled</a>' : (($appointment['status'] == '') 
                                ? 'Pending' 
                                : (($appointment['status'] == 'done') ? '<p class="text-success" style="margin-bottom: -10px;">'.ucfirst($appointment['status']).'<p>' :'<p class="text-info" style="margin-bottom: -10px;">'.ucfirst($appointment['status'].'<p>')))
                                ; 
                                ?>
                                <!-- Modal To Show The Cancellation Details -->
                                <div id="cancelDetails" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                        <div class="modal-body">
                                            <div class="card-body p-sm-5" style="font-family: Alexandria, sans-serif;box-shadow: 3px 3px var(--bs-primary-border-subtle);border-radius: 6px;">
                                                <h2 class="text-center mb-4" style="color: #6c757d;">Cancellation Details</h2>
                                                
                                                    <p>Cancelled on <?php echo date('M-d-Y', strtotime($appointment['updated_at'])); ?></p>
                                                    <label for="date">Details</label>
                                                    <p id=details class="form-control"><?php echo $appointment['cancel_details'] ; ?></p>
                                                    <div class="pt-3">
                                                        <small>Click outside the window to close</small>
                                                    </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End Modal -->
                            </td>
                                <td><?php echo date('M-d-Y', strtotime($appointment['created_at'])); ?></td>
                                <td class="d-lg-flex justify-content-lg-start">
                        
                                    <?php if($appointment['status'] == '' and $appointment['cancel_details'] == null ) :?>
                                     <button onclick="approveAppointment(<?php echo $appointment['id']; ?>)" class="btn btn-outline-success btn-sm">Approve</button>
                                    
                                    <?php endif; ?>
                                    <?php if($appointment['status'] == 'Approved') :?>
                                    <button onclick="addRecords(<?php echo $appointment['id']; ?>)" class="btn btn-outline-info btn-sm" 
                                    type="button" style="border-style: none; margin-left: 10px;">Done</button>
                                    <?php endif; ?>
                                    <button onclick="deleteAppointment(<?php echo $appointment['id']; ?>)" class="btn btn-outline-danger btn-sm" 
                                    type="button" style="border-style: none; margin-left: 10px;">Delete</button></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
</div>
<?php include(__DIR__ . './../_footer.php'); ?>