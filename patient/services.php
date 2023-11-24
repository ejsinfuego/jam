<?php 
$title = 'Services';
include_once(__DIR__ . '/../_header_v2.php'); 

//code to retreive services from database
$services = $database->query("select * from services");
$availableServices = $services->fetch_assoc();

?>
            <div class="col">
                <section>
                <?php if(isset($_SESSION['message']) && $_SESSION['message'] !=''){
                    echo '<div id="message" class="alert text-center text-bold fade show" role="alert" style="margin-top: 18px; font-family: Alexandria, sans-serif; background-color: none;">'.$_SESSION['message'].'</div>';
                    unset($_SESSION['message']);} ?>
                    <div style="height: 272px;background: url(&quot;../assets/img/clinic.jpg&quot;) center / cover;font-family: Alexandria, sans-serif;border-radius: 6px;border: 2px solid var(--bs-primary-border-subtle);box-shadow: 5px 5px #abb2b9;"></div>
                    <div class="container h-100 position-relative" style="top: -50px; ">
                        <div class="row gy-5 gy-lg-3 row-cols-1 row-cols-md-2 row-cols-lg-3 flex-grow-0">
                        <?php foreach($services as $availableServices) : ?>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body pt-4 p-4" style="font-family: Alexandria, sans-serif;border: 2px solid #abb2b9;box-shadow: 3px 3px #abb2b9;border-radius: 6px;">
                                    <form method="get" action="calendar.php">
                                        <input type="hidden" name="serviceName" value="<?php echo $availableServices['id']; ?>">
                                        <h4 class="card-title" id="serviceName"><?php echo $availableServices['service']; ?></h4>   
                                        <p class="card-text" style="font-size: 15px;"><?php echo $availableServices['description']; ?></p>
                                    </div>
                                    <?php if(isset($_SESSION['usertype']) == 'p') : ?>
                                    <div class="card-footer p-4 py-3">
                                    <button style="border: none; background-color: #ffffff;" type="submit"><a style="font-family: Alexandria, sans-serif;color: var(--bs-secondary);" id="service" >Book an Appointment&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right">
                                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                                            </svg></a>
                                    </button>
                                    </form></div>
                                    <?php else : ?>
                                    <div class="card-footer p-4 py-3"><a href="#" style="font-family: Alexandria, sans-serif;color: var(--bs-secondary);">Edit Thise&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right">
                                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                                        </svg></a></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#service').click(function(){
                var service = '$_SESSION["service"] = '+$('#serviceName').innerText;
                $('#header').add()
            });
        });
    </script>
<?php include_once(__DIR__ . '/../_footer.php'); ?>