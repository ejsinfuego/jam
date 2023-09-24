<?php

$title = 'Profile';
include(__DIR__ . '/../_header_v2.php');

if ($_SESSION['usertype'] == ' ') {
    header('location: ../login-1.php');
    
}

if($_GET){
    $userid = $_GET['id'];

    $patient = $database->query("SELECT * FROM patient WHERE id = '$userid'");
    $patient = $patient->fetch_assoc();

    //inner join from appointments to records to tooth table
    $records = $database->query("SELECT * FROM records INNER JOIN appointments ON records.appointment_id = appointments.id INNER JOIN tooth ON records.tooth_id = tooth.id WHERE patient_id = '$userid'");
}
?>
<script>
    $(document).ready(function(){
        $('#teethTable').DataTable({
        paginate: false,
    });
    });
    
    function viewDetails(appointmentDate, appointmentTime, service){
        $('#my-modal').modal('show');
        $('#appDate').html(appointmentDate);
        $('#appTime').html(appointmentTime);
        $('#service').html(service);
  
       
      

    }
</script>
<div class="col">
   
        <div class="col-xl-9 col-lg-9 col-md-12 col-sm-12 col-12">
            <div class="card h-100 p-4" style="font-family: Alexandria, sans-serif;border-radius: 6px;box-shadow: 2px 2px var(--bs-primary-border-subtle);border: 2px solid var(--bs-primary-border-subtle);width: auto;">
                <div class="card-body">
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="mb-2 text-primary">Personal Details</h6>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="fullName">First  Name</label><input id="fullName" class="form-control" type="text" placeholder="<?php echo $patient['first_name']; ?>" /></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="fullName">Last Name</label><input id="fullName" class="form-control" type="text" placeholder="<?php echo $patient['last_name']; ?>" /></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="eMail">Email</label><input id="eMail" class="form-control" type="email" placeholder="<?php echo $patient['email']; ?>"/></div>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="phone">Phone</label><input id="phone" class="form-control" type="text" placeholder="<?php echo $patient['contact_number']; ?>" /></div>
                        </div>
                         <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                            <div class="form-group"><label for="phone">Sex</label><input id="phone" class="form-control" type="text" placeholder="<?php echo ucfirst($patient['sex']); ?>"/></div>
                        </div>

                    </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="mb-2 text-primary">Dental Records</h6>
                        </div>
                        <div class="d-flex">
                        <table id="teethTable" class="table table-bordered table-sm table-responsive">
                            <thead>
                                <tr>
                                    <th scope="col">Tooth Name</th>
                                    <th scope="col">Tooth Number</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($records as $record): ?>
                                    <?php $service = $database->query('select service from services where id = '.$record['service_id'].'');
                                    $service = $service->fetch_column(); ?>
                                <tr>
                                    <td><?php echo $record['tooth_name']; ?></td>
                                    <td><?php echo $record['tooth_number']; ?></td>
                                    <td>
                                        <button onclick="viewDetails('<?php echo $record['appointmentDate']; ?>', '<?php echo date('h:i A', strtotime($record['appointmentTime'])); ?>', '<?php echo $service; ?>')" class="btn btn-sm btn-primary">View Details</button>
                                    </td>
                                    <div id="my-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="false">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <label>Appointment Date</label>
                                                    <p class="form-control" id="appDate"><?php echo $record['appointmentDate'];?></p>
                                                    <label>Appointment Time</label>
                                                    <p class="form-control" id="appTime"></p>
                                                    <label>Service</label>
                                                    <p class="form-control" id="service"><?php echo $service; ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
<?php include(__DIR__ . '/../_footer.php'); ?>
