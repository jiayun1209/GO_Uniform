<?php
require_once('../../config.php');
if (isset($_GET['vendor_ID']) && $_GET['vendor_ID']!= '') {
    $qry = $conn->query("SELECT * from `vendor` where vendor_ID = '{$_GET['vendor_ID']}' ");
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
            <dt class="col-md-4">Supplier Name</dt>
            <dd class="col-md-8">: <?php echo $name ?></dd>
            <dt class="col-md-4">Company Code</dt>
            <dd class="col-md-8">: <?php echo $company_code ?></dd> 
            <dt class="col-md-4">Registration Status</dt>
            <dd class="col-md-8">: 
                <?php if ($registration_status == 1): ?>
                    <span class="badge badge-success">Approved</span>
                <?php else: ?>
                    <span class="badge badge-secondary">Rejected</span>
                <?php endif; ?>
            </dd>
            <dt class="col-md-4">Email</dt>
            <dd class="col-md-8">: <?php echo $email ?></dd>
            <dt class="col-md-4">Product</dt>
            <dd class="col-md-8">: <?php echo $product ?></dd>         
        </dl>
    </callout>
    <div class="row px-2 justify-content-end">
        <div class="col-1">
            <button class="btn btn-dark btn-flat btn-sm" type="button" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>