<?php
require_once('../../config.php');
if (isset($_GET['pr_ID']) && $_GET['pr_ID'] > 0) {
    $qry = $conn->query("SELECT * from `purchase_requisition` where pr_ID = '{$_GET['pr_ID']}' ");
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
            
            <dt class="col-md-4">PR ID</dt>
            <dd class="col-md-8">: <?php echo $pr_ID ?></dd>
            <dt class="col-md-4">Staff ID</dt>
            <dd class="col-md-8">: <?php echo $staff_ID ?></dd>

            <dt class="col-md-4">Status</dt>
            <dd class="col-md-8">:&nbsp;
                <?php if ($status == 1): ?>
                    <span class="badge badge-success">Completed</span>
                <?php else: ?>
                    <span class="badge badge-secondary">Ongoing</span>
                <?php endif; ?>
            </dd>

           
        </dl>
    </callout>
    <div class="row px-2 justify-content-end">
        <div class="col-1">
            <button class="btn btn-dark btn-flat btn-sm" type="button" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>

