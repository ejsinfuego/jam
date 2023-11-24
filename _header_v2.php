<?php 
$title = $title ?? 'Famiñial Dental Clinic';
 ?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title><?php echo htmlspecialchars($title, ENT_QUOTES); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Alexandria&amp;display=swap">
    <link rel="preconnect" href="https://rsms.me/">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    <link rel="stylesheet" href="../assets/css/styles.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
</head>
<style>
    .nav-link:hover {
        text-decoration: none;
        background-color: #6786a3;
    }

    .card-text{
        font-family: Inter, sans-serif;
    }
</style>
<script>
    //ajax function to delete a service from database
    function deleteService(id){
        var xhttp = new XMLHttpRequest();
        responseText = confirm("Are you sure you want to delete this service?");
        if(responseText == false){
            return;
        }
        xhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                location.reload();
            }
        };
        xhttp.open("GET", "delete_service.php?id="+id, true);
        xhttp.send();
    }


     //logout function
     $('#logout').click(function(){
        responseText = confirm("Are you sure you want to logout?");
        if(responseText == false){
            return;
        }
        window.location.href = "../logout.php";
    });

    function cancelAppointment(id){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                location.reload();
            }
        };
        //post method of ajax
        xhttp.open("POST", "cancelAppointment.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("id="+id+"&cancel_details="+document.getElementById('cancel_details').value);
        $('#secondModal').modal('show');
        
    }

    function editAppointment(id){
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                location.reload();
            }
        };
        xhttp.open("GET", "editAppointment.php?id="+id, true);
        xhttp.send();

    }
    function deleteAppointment(appointment_id){
        var xhttp = new XMLHttpRequest();
        if(confirm("Are you sure you want to delete this appointment?")){
            xhttp.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    $('#secondModal').modal('show');
                    $('#message').html("Appointment deleted successfully.");
                    window.location.reload();
                   
                }
            };
            xhttp.open("GET", "deleteAppointment.php?appointment_id="+appointment_id, true);
            xhttp.send();
           
        }
       
    }

    $(document).ready(function() {
    $('#sortTable').DataTable({
       destroy: true,
       responsive: true,

    });

    $('#myModal').modal('show');

    $('.cancelButton').click(function(){
            $('#cancelModal').modal('show');
        });

    });


</script>
<?php
session_start();
    //This script check whether the user is logged in, what type of user.

    if(isset($_SESSION["user"])){
        if(($_SESSION["user"])=="" or $_SESSION['usertype']!='p' and $_SESSION['usertype']!='d'){
            header("location: ../login-1.php");
        }else{
            $useremail=$_SESSION["user"];
        }
    }else{
        header("location: ../login-1.php");
    }
    
    if($_SESSION['usertype']=='p'){
        include("connection.php");
        $userrow = $database->query("select * from patient where email='$useremail'");
        $userfetch=$userrow->fetch_assoc();
        $userid= $userfetch["id"];
        $_SESSION['userid'] = $userid;
        $username=$userfetch["first_name"];
        //THese are the link for patient. Will have to fix the routing.
        $med_link = "../patients/request_medicine.php";
        $med_link_sidebar = "../patients/medicine_requests.php";
        $appointment_link = "appointments.php";
        $index = "../patients/index.php";
        $services = "../patient/services.php";
        $patients = "profile.php";
    }else{
        //import database
        include("connection.php");
        $userrow = $database->query("select * from doctor where email='$useremail'");
        $userfetch=$userrow->fetch_assoc();
        $userid= $userfetch["id"];
        $username=$userfetch["first_name"]." ".$userfetch["last_name"];
          //These are the link for clinic side. Will have to fix the routing.
        $med_link = "../doctors/medicine_inventory.php";
        $appointment_link = "../doctors/appointments.php";
        $med_link_sidebar = "../doctors/medicine_requests.php";
        $appointment_link_sidebar = "../doctors/appointments.php";
        $services = "../doctors/services.php";
        $add_service = "../doctors/add_service.php";
        $index = "../doctors/index.php";
        $patients = "../doctors/check_patients.php";
    }

    if(isset($_SESSION['message']) && $_SESSION['message'] !='' && isset($_SESSION['show_modal']) && $_SESSION['show_modal'] !=''){
        $myModal = $_SESSION['show_modal'];
        
    }


?><body style="background: #fbfff1;">
<div id="<?php echo $myModal; ?>" class="modal fade" style="font-family: Alexandria, sans-serif;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title">Notice</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p><?php echo $_SESSION['message'];?></p>
            </div>
            <div class="modal-footer">
                <button data-bs-dismiss="modal" class="btn btn-outline-primary">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<div id="logout" class="modal fade" style="font-family: Alexandria, sans-serif;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="my-modal-title"></h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure to logout?</p>
            </div>
            <div class="modal-footer">
                <button data-bs-dismiss="modal" class="btn btn-outline-primary">
                    <a href="../logout.php" style="text-decoration: none;">Yes</a>
                </button>
                <button data-bs-dismiss="modal" class="btn btn-outline-primary">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
    <div class="container" style="margin-top: 18px;">
        <div class="row df-l mb-3" id="header">
            <nav class="col navbar d-flex navbar-expand-md bg-body d-flex d-xxl-flex flex-row justify-content-center align-items-center justify-content-xxl-center align-items-xxl-center py-3" style="background: rgb(44,62,80);font-family: Alexandria, sans-serif;border-radius: 6px;box-shadow: 2px 2px var(--bs-primary-border-subtle);border: 2px solid var(--bs-primary-border-subtle);width: auto;">
                <div class="container-fluid"><a class="navbar-brand d-flex align-items-center" href="index.php"><img src="../assets/img/logo.png" width="65" height="65" /><span class="d-flex px-sm-4" style="color: var(--bs-gray-600);text-shadow: 1px 1px #1abc9c;margin-left: -19px;margin-right: -19px;">Orfanel-Mendoza Dental Clinic</span></a><a class="px-lg-5 px-xxl-3"><?php echo $username; ?></a><button class="navbar-toggler" data-bs-toggle="collapse"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button></div>
            </nav>
        </div>
    </div>
            <div class="container" style="margin-top: 15px;">
            <div class="row">
            <div class="col pt-3 col-md-2 col-lg-2 col-xxl-2 d-flex flex-column pb-4" style="background: #4c657d; font-family:'Inter', sans-serif;border-radius: 6px;box-shadow: 5px 5px 0px var(--bs-primary-border-subtle); font-size: 14px; font-size: 15px;">
                <a href="calendar.php" class="d-flex d-lg-flex d-xxl-flex p-1 nav-link" style="margin-top: 0px; border-radius: 5px; color: white;">
                        <div class="pe-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-32 0 512 512" width="1em" height="1em" fill="currentColor" style="font-size: 40px;background: #6786a3;padding: 9px;border-radius: 15px;">
                                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M216.1 408.1C207.6 418.3 192.4 418.3 183 408.1L119 344.1C109.7 335.6 109.7 320.4 119 311C128.4 301.7 143.6 301.7 152.1 311L200 358.1L295 263C304.4 253.7 319.6 253.7 328.1 263C338.3 272.4 338.3 287.6 328.1 296.1L216.1 408.1zM128 0C141.3 0 152 10.75 152 24V64H296V24C296 10.75 306.7 0 320 0C333.3 0 344 10.75 344 24V64H384C419.3 64 448 92.65 448 128V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V128C0 92.65 28.65 64 64 64H104V24C104 10.75 114.7 0 128 0zM400 192H48V448C48 456.8 55.16 464 64 464H384C392.8 464 400 456.8 400 448V192z"></path>
                            </svg></div>
                        <div class="pt-2">
                            <p style="margin-bottom: 0px;">Calendar</p>
                        </div>
                </a>
                <a href="<?php echo $appointment_link; ?>"class="d-flex d-lg-flex d-xxl-flex p-1 nav-link" style="margin-top: 0px; border-radius: 5px; color: white;">
                        <div class="pe-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-32 0 512 512" width="1em" height="1em" fill="currentColor" style="font-size: 40px;background: #6786a3;padding: 9px;border-radius: 15px;">
                                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M152 64H296V24C296 10.75 306.7 0 320 0C333.3 0 344 10.75 344 24V64H384C419.3 64 448 92.65 448 128V448C448 483.3 419.3 512 384 512H64C28.65 512 0 483.3 0 448V128C0 92.65 28.65 64 64 64H104V24C104 10.75 114.7 0 128 0C141.3 0 152 10.75 152 24V64zM48 248H128V192H48V248zM48 296V360H128V296H48zM176 296V360H272V296H176zM320 296V360H400V296H320zM400 192H320V248H400V192zM400 408H320V464H384C392.8 464 400 456.8 400 448V408zM272 408H176V464H272V408zM128 408H48V448C48 456.8 55.16 464 64 464H128V408zM272 192H176V248H272V192z"></path>
                            </svg></div>
                        <div class="pt-2">
                            <p style="margin-bottom: 0px;">Appointments</p>
                        </div>
                </a>
                <a href="<?php echo $patients ?>" class="d-flex d-lg-flex d-xxl-flex p-1 nav-link" style="margin-top: 0px; border-radius: 5px; color: white;">
                        <div class="pe-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="-32 0 512 512" width="1em" height="1em" fill="currentColor" style="font-size: 40px;background: #6786a3;padding: 9px;border-radius: 15px;">
                                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M272 304h-96C78.8 304 0 382.8 0 480c0 17.67 14.33 32 32 32h384c17.67 0 32-14.33 32-32C448 382.8 369.2 304 272 304zM48.99 464C56.89 400.9 110.8 352 176 352h96c65.16 0 119.1 48.95 127 112H48.99zM224 256c70.69 0 128-57.31 128-128c0-70.69-57.31-128-128-128S96 57.31 96 128C96 198.7 153.3 256 224 256zM224 48c44.11 0 80 35.89 80 80c0 44.11-35.89 80-80 80S144 172.1 144 128C144 83.89 179.9 48 224 48z"></path>
                            </svg></div>
                        <div class="pt-2">
                            <p style="margin-bottom: 0px;"><?php echo ($_SESSION['usertype'] == 'p') ? 'Profile' : 'Patients' ; ?></p>
                        </div>
                </a>
                <a href="<?php echo $services; ?>"class="d-flex d-lg-flex d-xxl-flex p-1 nav-link" style="margin-top: 0px; border-radius: 5px; color: white;">
                        <div class="pe-2"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="1em" height="1em" fill="currentColor" style="font-size: 40px;padding: 8px;background: #6786a3;border-radius: 15px;">
                                <!--! Font Awesome Free 6.1.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free (Icons: CC BY 4.0, Fonts: SIL OFL 1.1, Code: MIT License) Copyright 2022 Fonticons, Inc. -->
                                <path d="M256 352C293.2 352 319.2 334.5 334.4 318.1C343.3 308.4 358.5 307.7 368.3 316.7C378 325.7 378.6 340.9 369.6 350.6C347.7 374.5 309.7 400 256 400C202.3 400 164.3 374.5 142.4 350.6C133.4 340.9 133.1 325.7 143.7 316.7C153.5 307.7 168.7 308.4 177.6 318.1C192.8 334.5 218.8 352 256 352zM208.4 208C208.4 225.7 194 240 176.4 240C158.7 240 144.4 225.7 144.4 208C144.4 190.3 158.7 176 176.4 176C194 176 208.4 190.3 208.4 208zM304.4 208C304.4 190.3 318.7 176 336.4 176C354 176 368.4 190.3 368.4 208C368.4 225.7 354 240 336.4 240C318.7 240 304.4 225.7 304.4 208zM512 256C512 397.4 397.4 512 256 512C114.6 512 0 397.4 0 256C0 114.6 114.6 0 256 0C397.4 0 512 114.6 512 256zM256 48C141.1 48 48 141.1 48 256C48 370.9 141.1 464 256 464C370.9 464 464 370.9 464 256C464 141.1 370.9 48 256 48z"></path>
                            </svg></div>
                        <div class="pt-2">
                            <p style="margin-bottom: 0px;">Services</p>
                        </div>
                </a>
                <a href="events.php" class="d-flex d-lg-flex d-xxl-flex p-1 nav-link" style="margin-top: 0px; border-radius: 5px; color: white;">
                        <div class="pe-2"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-file-earmark-image" style="font-size: 40px;padding: 8px;border-radius: 15px;border-color: #1abc9c;background: #6786a3;">
                                <path d="M6.502 7a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"></path>
                                <path d="M14 14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5V14zM4 1a1 1 0 0 0-1 1v10l2.224-2.224a.5.5 0 0 1 .61-.075L8 11l2.157-3.02a.5.5 0 0 1 .76-.063L13 10V4.5h-2A1.5 1.5 0 0 1 9.5 3V1H4z"></path>
                            </svg></div>
                        <div class="pt-2">
                            <p style="margin-bottom: 0px;">Events</p>
                        </div>
                </a>
            <a href="#" class="logoutButton d-flex d-lg-flex d-xxl-flex p-1 nav-link" style="margin-top: 0px; border-radius: 5px; color: white;">
                        <div class="pe-2"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-power" style="font-size: 40px;padding: 8px;border-radius: 15px;border-color: #1abc9c;background: #6786a3;">
                                <path d="M7.5 1v7h1V1h-1z"></path>
                                <path d="M3 8.812a4.999 4.999 0 0 1 2.578-4.375l-.485-.874A6 6 0 1 0 11 3.616l-.501.865A5 5 0 1 1 3 8.812z"></path>
                            </svg></div>
                        <div class="pt-2">
                            <p style="margin-bottom: 0px;">Logout</p>
                        </div>
            </a>
                    <!-- <div class="logout modal fade" role="dialog" tabindex="-1" id="modal-1">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Sure?</h4><button class="btn-close" type="button" aria-label="Close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p>You are about to log out.</p>
                                </div>
                                <div class="modal-footer"><button class="btn btn-light" type="button" data-bs-dismiss="modal">Stay</button><button class="btn btn-primary" type="button">Yes</button></div>
                            </div>
                        </div>
                    </div> -->
                </div>