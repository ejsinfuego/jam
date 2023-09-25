<?php

$title = 'Events';
include(__DIR__. './../_header_v2.php');

if ($_SESSION['usertype'] != 'p') {
    header('location: something_went_wrong.php');
}

?>
<div class="col-xxl-4 pb-3">
    <div class="card" style="Alexandria, sans-serif;border-radius: 6px;box-shadow: 2px 2px var(--bs-primary-border-subtle);border: 2px solid var(--bs-primary-border-subtle);width: auto;"><img class="card-img-top w-100 d-block fit-cover" style="height: 200px; " src="https://cdn.bootstrapstudio.io/placeholders/1400x800.png" />
        <div class="card-body p-4">
            <p class="text-primary card-text mb-0">Article</p>
            <h4 class="card-title">Lorem libero donec</h4>
            <p class="card-text">Nullam id dolor id nibh ultricies vehicula ut id elit. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus.</p>
            </div>
        </div>
</div>
<?php if($_SESSION['usertype']== 'd') :?>
<div class="col-xxl-4">
                <div class="card" style="Alexandria, sans-serif;border-radius: 6px;box-shadow: 2px 2px var(--bs-primary-border-subtle);border: 2px solid var(--bs-primary-border-subtle);width: auto;">
                    <div class="card-body p-4"><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="var(--bs-primary-border-subtle)" viewBox="0 0 16 16" class="bi bi-plus-lg" style="font-size: 316px;">
                            <path fill-rule="evenodd" d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2Z"></path>
                        </svg></div>
                </div>
            </div>
<?php endif; ?>



<?php include('../_footer.php'); ?>
