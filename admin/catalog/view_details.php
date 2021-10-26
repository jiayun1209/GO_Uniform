<?php
require_once('../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT c.*,v.name from `catalog` c inner join `vendor` v on c.vendor_ID = v.vendor_ID where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=stripslashes($v);
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
            <dt class="col-md-4">Catalog ID</dt>
            <dd class="col-md-8">: <?php echo $catalog_ID ?></dd>
            <dt class="col-md-4">Description</dt>
            <dd class="col-md-8">: <?php echo $description ?></dd>
            <dt class="col-md-4">Vendor ID</dt>
            <dd class="col-md-8">: <?php echo $vendor_ID ?></dd>
            <dt class="col-md-4">Vendor Name</dt>
            <dd class="col-md-8">: <?php echo $name ?></dd>
        </dl>
    </callout>
    <div class="row px-2 justify-content-end">
        <div class="col-1">
            <button class="btn btn-dark btn-flat btn-sm" type="button" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>