<?php

$title = 'Events';
include(__DIR__. './../_header_v2.php');

if ($_SESSION['usertype'] != 'd') {
    header('location: something_went_wrong.php');
}

$events = $database->query('select * from events');


?>
<style>
    .addEvent:hover{
        cursor: pointer;
        background-color: rgba(33,37,41,0.07);
    }
</style>
<script>
    function addEvent(){
        $('#addEvent').modal('show');
    }
</script>
<div id="addEvent" style="font-family: Alexandria, sans-serif;box-shadow: 3px 3px var(--bs-primary-border-subtle);border-radius: 6px;" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content p-5">
            <div class="modal-body">
                <div>
                    <h2 class="text-center mb-4" style="color: #6c757d;">Add Event</h2>
                    <hr class="border-2 border-black">
                </div>
                <form method="post" action="addEvent.php" enctype="multipart/form-data">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" name="title" id="title"/>
                    <label for="title">Description</label>
                    <textarea type="text" class="form-control" name="description" id="description"></textarea>
                    <label for="start">Start</label>
                    <input type="date" class="form-control" name="start" id="start"/>
                    <label for="end">End</label>
                    <input type="date" class="form-control" name="end" id="end"/>
                    <label for="file">Image</label>
                    <input type="file" class="form-control" name="file" id="file"/>
                    <div class="pt-4">
                        <button type="submit" class="btn btn-primary">Add Event</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
<div class="col d-flex flex-wrap">
<?php foreach($events as $event) : ?>
<section>
    <div class="row gy-5 gy-lg-2 row-cols-1 row-cols-md-2 row-cols-lg-1">
        <div class="col-xxl-2 m-4">
           <div class="card mx-4" style="Alexandria, sans-serif;border-radius: 6px;box-shadow: 2px 2px var(--bs-primary-border-subtle);border: 2px solid var(--bs-primary-border-subtle);width: auto;"><img class="card-img-top w-100 d-block fit-cover" style="height: 200px; " src="<?php echo (isset($event['image'])) ? 'eventpics/'.$event['image'] :'https://cdn.bootstrapstudio.io/placeholders/1400x800.png' ; ?>"/>
        <div class="card-body p-4">
            <p class="text-primary card-text mb-0">Promo</p>
            <h4 class="card-title"><?php echo $event['title']; ?></h4>
            <hr style="border: 1px solid #6c757d;">
            <p class="card-text"><?php echo $event['description']; ?></p>
            <p>Start on <strong><?php echo $event['start'] ?></strong> until <strong><?php echo $event['end']; ?></strong></p>
            </div>
        </div> 
    </div>
</div>
</section>
<?php endforeach; ?>
<?php if($_SESSION['usertype']== 'd') :?>
    <section>
    <div class="row gy-5 gy-lg-2 row-cols-1 row-cols-md-2 row-cols-lg-1">
    <div class="col-xxl-2 m-4" onclick="addEvent()">
    <div class="card addEvent" style="Alexandria, sans-serif;border-radius: 6px;box-shadow: 3px 3px var(--bs-primary-border-subtle);border: 2px solid var(--bs-primary-border-subtle);width: auto;">
                    <div class="card-body p-4"><svg class="p-5" xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="var(--bs-primary-border-subtle)" viewBox="0 0 16 16" class="bi bi-plus-lg" style="font-size: 316px;">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"></path>
                        </svg></div>
                </div>
    </div>
        

    </div>
    </section>
<?php endif; ?>
</div>


<?php include('../_footer.php'); ?>
