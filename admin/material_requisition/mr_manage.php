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

<form action="" id="mr-form">
    
    <input type="hidden" name="mr_ID" value="" readonly>
    <div class="container-fluid">
       
    
        <div class="form-group">
            <label for="staff_ID" class="control-label">Staff Name</label>
            <select name="staff_ID" id="staff_ID" class="custom-select custom-select-sm rounded-0 select3">
                <option value="" disabled <?php echo!isset($staff_ID) ? "selected" : '' ?>></option>
                <?php
                $mr_qry = $conn->query("SELECT * FROM `staff` WHERE type!=0 order by `username` asc");
                while ($row = $mr_qry->fetch_assoc()):
                    ?>
                    <option value="<?php echo $row['id'] ?>" <?php echo isset($staff_ID) && $staff_ID == $row['id'] ? 'selected' : '' ?>><?php echo $row['username'] ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="description" class="control-label">Description</label>
            <input type ="text" name="description" id="description" class="form-control rounded-0" value="<?php echo isset($description) ? $description : " " ?>" readonly>
        </div>

        <div class="form-group">
            <label for="type" class="control-label">Type</label>
            <input type="text" name="type" id="type" class="form-control rounded-0" value="<?php echo isset($type) ? $type : " " ?>" >
        </div>
        

        <div class="form-group">
            <label for="status" class="control-label">Status</label>
            <select name="status" id="status" class="form-control rounded-0" required>
                <option value="1" <?php echo isset($status) && $status == 1 ? "selected" : "1" ?> >Completed</option>
                <option value="0" <?php echo isset($status) && $status == 0 ? "selected" : "0" ?>>Ongoing</option>
            </select>
        </div>

    </div>
</form>


<script>
    $(function () {
        $('#mr-form').submit(function (e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/MR.php?f=add_mr",
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

