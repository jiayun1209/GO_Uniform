<?php
require_once('../../config.php');
if (isset($_GET['vendor_ID']) && $_GET['vendor_ID'] != '') {
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
                <?php elseif ($registration_status == 2): ?>
                    <span class="badge badge-warning">Registered</span>
                <?php elseif ($registration_status == 3): ?>
                    <span class="badge badge-secondary">Invited</span>
                <?php else: ?>
                    <span class="badge badge-dark">Rejected</span>
                <?php endif; ?>
            </dd>
            <dt class="col-md-4">Email</dt>
            <dd class="col-md-8">: <?php echo $email ?></dd>
            <dt class="col-md-4">Product</dt>
            <dd class="col-md-8">: <?php echo $product ?></dd> 
            <dt class="col-md-4">Rating&#11088; (0 to 5)</dt>
            <dd class="col-md-8">: 
                <?php
                if (isset($vendor_ID)):
                    $supplier_qry = $conn->query("SELECT r.*,v.*,m.* FROM `rating_measurement` m, vendor v, rating r WHERE r.vendor_ID = v.vendor_ID and r.performance_ID = m.performance_ID and v.vendor_ID ='$vendor_ID'");
                    while ($row = $supplier_qry->fetch_assoc()):
                        ?>
                        <?php echo $row['rating_ID'] ?>&#9733; <?php echo isset($rating_ID) && $rating_ID == $row['rating_ID'] ? 'selected' : '' ?>
                    <?php endwhile;
                endif ?></dd>
        </dl>
    </callout>
    <div class="row px-2 justify-content-end">
        <div class="col-1">
            <button class="btn btn-dark btn-flat btn-sm" type="button" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>