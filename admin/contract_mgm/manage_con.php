<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `contract` where id = {$_GET['id']} ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}
if (isset($_POST['save'])) {
    require_once '../classes/DBConnection.php';
    $enddate = $_POST['endDate'];
    $remarks = $_POST['remarks'];
    $query = mysqli_query($conn, "UPDATE contract set endDate = '$enddate' where id = {$_GET['id']} ");
    if ($query){
        echo "<script>alert('You are successfully updated');</script>";
    } else {
        echo "<script>alert('Not updated something went worng');</script>";
    }  
}
?>
<style>
    span.select2-selection.select2-selection--single {
        border-radius: 0;
        padding: 0.25rem 0.5rem;
        padding-top: 0.25rem;
        padding-right: 0.5rem;
        padding-bottom: 0.25rem;
        padding-left: 0.5rem;
        height: auto;
    }
    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

</style>
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title"><?php echo isset($id) ? "Update Contract Date" : "New Contract" ?> </h3>
                 <div class="card-tools">            
            <a class="btn btn-sm btn-flat btn-primary" href="?page=contract_mgm/view_con&id=<?php echo $id ?>">View</a>
            <a class="btn btn-sm btn-flat btn-default" href="?page=contract_mgm">Back</a>
        </div>
    </div>
    <div class="card-body">
        <form action="" id="po-form" method="post">
            <input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
            <div class="row">               
                <div class="col-md-6 form-group">
                    <label for="contract_ID">Contract ID # <span class="po_err_msg text-danger"></span></label>
                    <input type="text" class="form-control form-control-sm rounded-0" id="contract_ID" name="contract_ID" value="<?php echo isset($contract_ID) ? $contract_ID : '' ?>">
                    <small><i>Leave this blank to Automatically Generate upon saving.</i></small>
                </div>                
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-striped table-bordered" id="item-list">
                        <colgroup>                           
                            <col width="5%">
                            <col width="20%">
                            <col width="20%">
                            <col width="20%">
                        </colgroup>
                        <thead>
                        <br>
                        <tr class="bg-navy disabled">
                            <th class="px-1 py-1 text-center"></th>
                            <th class="px-1 py-1 text-center">Staff ID</th>
                            <th class="px-1 py-1 text-center">Start Date</th>
                            <th class="px-1 py-1 text-center">End Date</th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($id)):                               
                                $sub = $conn->query("SELECT c.*, s.* from contract c, staff s where c.staff_ID = s.id and c.id = '$id'");
                                echo $conn->error;
                                while ($row = $sub->fetch_assoc()):
                                    ?>
                                    <tr class="po-item" data-id="">
                                        <td class="align-middle p-1 text-center">
                                            <button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
                                        </td>
                                         <td class="align-middle p-1 sub_id "><?php echo $row['staff_ID'] ?></td>                                                                             
                                         <td class="align-middle p-1 date "><?php echo $row['startDate'] ?></td>
                                         <td class="align-middle p-1">
                                             <input type="text" name="endDate" id="endDate" required autofocus>
                                        </td>
                                    </tr>
                                    <?php
                                endwhile;
                            endif;
                            ?>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="remarks" class="control-label">Remarks</label>
                            <textarea name="remarks" id="remarks" cols="10" rows="4" class="form-control rounded-0" value=""></textarea>
                        </div>                       
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <button type="submit" name="save" class="btn btn-flat btn-primary" form="po-form" >Save</button>
        <a class="btn btn-flat btn-default" href="?page=contract_mgm">Cancel</a>
    </div>
</div>
