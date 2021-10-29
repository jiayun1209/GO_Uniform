<?php
require_once('../../config.php');
if(isset($_GET['subcontractor_ID']) && $_GET['subcontractor_ID'] > 0){
    $qry = $conn->query("SELECT s.*,c.company_name from `subcontractor` s inner join `company` c on s.company_code = c.company_code where s.subcontractor_ID = '{$_GET['subcontractor_ID']}' ");
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
            <dt class="col-md-4">Subcontractor ID</dt>
            <dd class="col-md-8">: <?php echo $subcontractor_ID ?></dd>
            <dt class="col-md-4">Company Name</dt>
            <dd class="col-md-8">: <?php echo $company_name ?></dd>
            <dt class="col-md-4">Subcontractor Name</dt>
            <dd class="col-md-8">: <?php echo $name ?></dd>
            <dt class="col-md-4">Email</dt>
            <dd class="col-md-8">: <?php echo $email ?></dd>
            <dt class="col-md-4">description</dt>
            <dd class="col-md-8">: <?php echo $description ?></dd>
        </dl>
    </callout>
    <div class="row px-2 justify-content-end">
        <div class="col-1">
            <button class="btn btn-dark btn-flat btn-sm" type="button" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>