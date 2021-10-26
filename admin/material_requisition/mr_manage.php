<?php
require_once('../../config.php');
if (isset($_GET['mr_ID']) && $_GET['mr_ID'] > 0) {
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
    <div class="card-body">
        <div class="container-fluid">
            <div id="msg"></div>

            <form action="" id="mr-form">
                <div class="container-fluid">

                    <input type="hidden" name="mr_ID" value="<?php echo isset($id) ? $id : '' ?>">
                    <div class="form-group">
                       
                    
                                        <div class="control-group">
                                            <label class="control-label" for="basicinput">Staff ID</label>
                                            <div class="controls">
                                                <select name="staff_ID" class="span8 tip" onChange="getStaff(this.value);"  required>
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
                        <label class="info-title" for="description">Description <span>*</span></label>
                        <input type="text" class="form-control unicase-form-control text-input" id="description" name="description" value="<?php echo isset($description) ? $description : "" ?>" required>

                    </div>


                    <div class="form-group">
                        <label class="info-title" for="type">Type <span>*</span></label>
                        <input type="text" class="form-control unicase-form-control text-input" id="type" name="type" value="<?php echo isset($type) ? $type : "" ?>" required>

                    </div>


                    <div class="form-group">
                        <label class="info-title" for="status">Status <span></span></label>
                        <input type="text" class="form-control unicase-form-control text-input" id="status" name="status" value="<?php echo isset($status) ? $status : "" ?>">

                    </div>

                </div>
            </form>
        </div>
    </div>
</div>


<script>
    $(function () {
        $('#mr-form').submit(function (e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: base_url + "classes/MR.php?f=add_mr",
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
    
    
        function getStaff(val) {
            $.ajax({
                type: "POST",
                url: "get_staff.php",
                data: 'staff_ID=' + val,
                success: function (data) {
                    $("#staff").html(data);
                }
            });
        }
  

</script>

