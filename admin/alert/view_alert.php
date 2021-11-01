<?php
require_once('../../config.php');
if (isset($_GET['alert_id']) && $_GET['alert_id']!= '') {
    $qry = $conn->query("SELECT * from `alert` where alert_id = '{$_GET['alert_id']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = stripslashes($v);
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none
    }
</style>
<div class="container fluid">
    <callout class="callout-primary">
        <dl class="row">
            <dt class="col-md-4">Alert Name</dt>
            <dd class="col-md-8">: <?php echo $alert_name ?></dd>
            <dt class="col-md-4">Description</dt>
            <dd class="col-md-8">: <?php echo $description ?></dd> 
             
                    
        </dl>
    </callout>
    <div class="row px-2 justify-content-end">
        <div class="col-1">
            <button class="btn btn-dark btn-flat btn-sm" type="button" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
