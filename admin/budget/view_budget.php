<?php
require_once('../../config.php');
if (isset($_GET['budget_no']) && $_GET['budget_no']!= '') {
    $qry = $conn->query("SELECT * from `budget_limit` where budget_no = '{$_GET['budget_no']}' ");
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
            
            <dt class="col-md-4">Budget ID</dt>
            <dd class="col-md-8">: <?php echo $budget_no ?></dd>
            <dt class="col-md-4">Staff ID</dt>
            <dd class="col-md-8">: <?php echo $staff_ID ?></dd>
            <dt class="col-md-4">Amount</dt>
            <dd class="col-md-8">: <?php echo $amount ?></dd> 
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
