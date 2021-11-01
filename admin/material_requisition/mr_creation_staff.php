<?php
if (isset($_GET['mr_ID']) && $_GET['mr_ID'] != "") {
    $qry = $conn->query("SELECT * from `materials_requisition` where mr_ID = '{$_GET['mr_ID']}' ");
    if ($qry->num_rows > 0) {
        foreach ($qry->fetch_assoc() as $k => $v) {
            $$k = stripslashes($v);
        }
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
</style>
<div class="card card-outline card-primary">
    
    <h2 align="center">Material Requisition Creation</h2>
    <div class="card-body">
        <div class="container-fluid">
            <div id="msg"></div>
            <form action="" id="manage-mr_create">	
                <input type="hidden" name="mr_ID" value="<?php echo isset($meta['mr_ID']) ? $meta['mr_ID'] : '' ?>">
                <div class="form-group"> <label class="control-label" for="basicinput">Staff ID</label>
            <div class="controls">
                <select name="staff_ID" class="custom-select custom-select-sm rounded-0 select3"  required>
                    <option value="">Select Staff ID</option> 
                    <?php
                    $query = mysqli_query($conn, "select * from staff");
                    while ($row = mysqli_fetch_array($query)) {
                        ?>

                        <option value="<?php echo $row['id']; ?>"><?php echo $row['id']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="description" class="control-label">Description</label>
            <input type ="text" name="description" id="description" class="form-control rounded-0" value=" "required>
        </div>
        <div class="form-group">
            <label for="type" class="control-label">Type</label>
            <input type ="text" name="type" id="type" class="form-control rounded-0" value=" "required>
        </div>
        
        <div class="form-group"> <label class="control-label" for="basicinput">Item ID</label>
            <div class="controls">
                <select name="item_id" class="custom-select custom-select-sm rounded-0 select3"  required>
                    <option value="">Select Item ID</option> 
                    <?php
                    $query = mysqli_query($conn, "select * from inventory");
                    while ($row = mysqli_fetch_array($query)) {
                        ?>

                        <option value="<?php echo $row['id']; ?>"><?php echo $row['id']; ?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
        
        <div class="form-group">
            <label for="type" class="control-label">Quantity Request</label>
            <input type="text" name="quantity_request" id="quantity_request" class="form-control rounded-0" value="<?php echo isset($quantity_request) ? $quantity_request : " " ?>" required>
        </div>
        
        <div class="form-group">
            <label for="status" class="control-label">Status</label>
            <select name="status" id="registration_status" class="form-control rounded-0" required>
                <option value="0" <?php echo isset($status) && $status == "" ? "selected" : "0" ?>>Ongoing</option>
            </select>
        </div>
            </form>
        </div>
    </div>
    <div class="card-footer">
        <div class="col-md-12">
            <div class="row">
                <button class="btn btn-sm btn-primary mr-2" form="manage-mr_create">Add</button>
                <a class="btn btn-sm btn-secondary" href="./?page=material_requisition/mr_creation_staff">Cancel</a>
            </div>
        </div>
    </div>
</div>
    
<script>
    
    $(function () {
        $('#manage-mr_create').submit(function (e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/MR.php?f=create_mr",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error: err => {
                    console.log(err)
                    alert_toast("An error occured", 'error');
                    end_loader();
                },
                success: function (resp) {
                    if (typeof resp == 'object' && resp.status == 'success') {
                        location.reload();
                    } else if (resp.status == 'failed' && !!resp.msg) {
                        var el = $('<div>')
                        el.addClass("alert alert-danger err-msg").text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                        $("html, body").animate({scrollTop: 0}, "fast");
                    } else {
                        alert_toast("An error occured", 'error');
                        console.log(resp)
                    }
                    end_loader()
                }
            })
        })
    })
</script>