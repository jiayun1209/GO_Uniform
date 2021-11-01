<?php
if (isset($_GET['id']) && $_GET['id'] > 0) {
    $qry = $conn->query("SELECT * from `contract` where id = {$_GET['id']} ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = $v;
        }
    }
}

if (isset($_POST['submit'])) {
    require_once '../classes/DBConnection.php';
    $contract_ID = "C-" . (sprintf("%'.05d", mt_rand(1, 99999)));
    /* $subcontractor_ID = $_POST['subcontractor_ID'];
      $vendor_ID = $_POST['vendor_ID'];
      $staff_ID = $_POST['staff_ID']; */
    $contract = $_POST['contract'];
    $id = $_POST['id'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $remarks = $_POST['remarks'];
    if ($contract == "subcontractor_ID") {
        $vendor_ID = 0;
        $staff_ID = 0;
        $subcontractor_ID = '$id';
        $query = mysqli_query($conn, "insert into contract(contract_ID,subcontractor_ID,vendor_ID,staff_ID,startDate,endDate,remarks) values('$contract_ID','$subcontractor_ID',$vendor_ID,$staff_ID,'$startDate','$endDate','$remarks')");
    } else if ($contract == "vendor_ID") {
        $subcontractor_ID = '0';
        $staff_ID = 0;
        $vendor_ID = $id;
        $query = mysqli_query($conn, "insert into contract(contract_ID,subcontractor_ID,vendor_ID,staff_ID,startDate,endDate,remarks) values('$contract_ID','$subcontractor_ID',$vendor_ID,$staff_ID,'$startDate','$endDate','$remarks')");
    }else{
        $subcontractor_ID = '0';
        $staff_ID = $id;
        $vendor_ID = 0;
        $query = mysqli_query($conn, "insert into contract(contract_ID,subcontractor_ID,vendor_ID,staff_ID,startDate,endDate,remarks) values('$contract_ID','$subcontractor_ID',$vendor_ID,$staff_ID,'$startDate','$endDate','$remarks')");
}
    if ($query) {
        echo "<script>alert('You are successfully created');</script>";
    } else {
        echo "<script>alert('Not created something went worng');</script>";
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

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }
    [name="tax_percentage"],[name="discount_percentage"]{
        width:5vw;
    }
</style>
<div class="card card-outline card-info">
    <div class="card-header">
        <h3 class="card-title"><?php echo isset($id) ? "Update Contract Date" : "New Contract" ?> </h3>
        <div class="card-tools">
            <a class="btn btn-sm btn-flat btn-default" href="?page=contract_mgm">Back</a>
        </div>
    </div>
    <div class="card-body">
        <form action="" id="po-form" method="POST">
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
                            <th class="px-1 py-1 text-center">Enter ID *</th>
                            <th class="px-1 py-1 text-center">Start Date</th>
                            <th class="px-1 py-1 text-center">End Date</th>
                        </tr>
                        </thead>
                        <tbody>
                            <tr class="po-item" data-id="">
                        <label for="contract_ID">Contract Person<span class="po_err_msg text-danger"></span></label>
                        <select id="fld-grp" name="contract" class="input-text form-control">
                            <option value="">--Please choose an option--</option>
                            <option name="subcontractor_ID" value="subcontractor_ID">Sub Contractor</option>
                            <option name="vendor_ID" value="vendor_ID">Vendor</option>
                            <option name="staff_ID" value="staff_ID">Staff</option>
                        </select>                      
                        <div class="validation-error"></div>
                        <small><i>Please choose one of the person that you want to create a new contract.</i></small>
                        <br> <br>
                        <td class="align-middle p-1 text-center">
                            <button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
                        </td> 
                        <td class="align-middle p-1">                                    
                            <input type="text" class="text-center w-100 border-0 id" name="id" value="" required/>
                        </td>                         
                        <td class="align-middle p-1">
                            <input type="text" name="startDate" id="startDate" class="text-center w-100 border-0 date" required>                                            
                        </td>
                        <td class="align-middle p-1">
                            <input type="text" name="endDate" id="endDate" class="text-center w-100 border-0 date" required>  
                        </td>
                        </tr>                           
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
            <div class="card-footer">
                <button id="submit" type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
                <a class="btn btn-flat btn-default" href="?page=contract_mgm">Cancel</a>
            </div>
        </form>
    </div>

</div>
<table class="d-none" id="item-clone">
    <tr class="po-item" data-id="">
        <td class="align-middle p-1 text-center">
            <button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
        </td> 
        <td class="align-middle p-1">
            <input type="hidden" name="id[]">
            <input type="text" class="text-center w-100 border-0 id" required/>
        </td>      
        <td class="align-middle p-1">
            <input type="hidden" name="date1[]">
            <input type="text" class="text-center w-100 border-0 date" required/>
        </td>
        <td class="align-middle p-1">
            <input type="hidden" name="date[]">
            <input type="text" class="text-center w-100 border-0 date" required/>
        </td>

    </tr>
</table>
