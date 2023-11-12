<?php 
include(__DIR__ . '/../_header_v2.php'); 
$title = 'Services';

$services = $database->query("select * from services");
$availableServices = $services->fetch_assoc();
?>
<style>
    .card-text{
        font-family: Inter, sans-serif;
    }
</style>
<div class="col">
                <section>
                    <p id="message"></p>
                    <div style="height: 272px;background: url(&quot;../assets/img/clinic.jpg&quot;) center / cover;font-family: Alexandria, sans-serif;border-radius: 6px;border: 2px solid var(--bs-primary-border-subtle);box-shadow: 5px 5px #abb2b9;"></div>
                    <div class="container h-100 position-relative" style="top: -50px; ">
                        <div class="row gy-5 gy-lg-3 row-cols-1 row-cols-md-2 row-cols-lg-3"><?php foreach($services as $availableServices) : ?>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body p-4" style="font-family: Alexandria, sans-serif;border: 2px solid #abb2b9;box-shadow: 3px 3px #abb2b9;border-radius: 6px;">
                                    <div class="d-flex justify-content-end align-items-end mb-2" style="margin-top: -20px; margin-right: -10px;"><button class="btn" onclick="deleteService(<?php echo $availableServices['id']; ?>)">×</button></div>
                                        <h4 id="serviceName"
                                        class="card-title"><?php echo $availableServices['service']; ?></h4>  
                                        <p class="card-text"><?php echo $availableServices['description']; ?></p>
                                    </div>
                                    <div class="card-footer p-4 py-3"><form method="get" action="edit_service.php"><input name='id' type="hidden" value="<?php echo $availableServices['id']; ?>" style="font-family: Alexandria, sans-serif;color: var(--bs-secondary);"><button class="btn" name="submit" type="submit">Edit This&nbsp;<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor" viewBox="0 0 16 16" class="bi bi-arrow-right">
                                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"></path>
                                        </svg></button></a>
                                    </form></div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                            <a href="add_service.php"><button class="btn" type="button" style="margin-top: 100px; background-color: #6786a3; font-family: Inter, sans-serif;">Add Service</button></a>
                        </div>
                    </div>
                </section>
            </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $('#service').click(function(){
                var service = "<?php $_SESSION['service'] =" + $('#service').val() + " ?>";
                $('#header').add(service);
            });
        });
    </script>
<?php include(__DIR__ . '/../_footer.php'); ?>