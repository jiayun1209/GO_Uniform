<?php
require_once('../../config.php');
if (isset($_GET['alert_id']) && $_GET['alert_id'] != "") {
    $qry = $conn->query("SELECT * from `alert` where alert_id = '{$_GET['alert_id ']}' ");
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
<form action="" id="alert-form">
    <input type="hidden" name="alert_id " value="<?php echo($alert_id ) ? $alert_id : "" ?>" readonly>
    <div class="container-fluid">
        <div class="form-group">
            <label for="alert_name" class="control-label">Alert Name</label>
            <input type="text" name="alert_name" id="alert_name" class="form-control rounded-0" value="<?php echo isset($alert_name) ? $alert_name : " " ?>" required>
        </div>
        <div class="form-group">
            <label for="description" class="control-label">Description</label>
            <input type="text" name="description" id="description" class="form-control rounded-0" value="<?php echo isset($description) ? $description : " " ?>" required>
        </div>
        <div class="form-group">
            <label for="date_alert" class="control-label">Date Created</label>
            <input type="datetime" name="date_alert" id="date_alert" class="form-control rounded-0" value="<?php echo isset($date_alert) ? $date_alert : " " ?>" required>
        </div>
    </div>
</form>
<script>
    $(function () {
        $('#alert-form').submit(function (e) {
            e.preventDefault();
            var _this = $(this)
            $('.err-msg').remove();
            start_loader();
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=save_alert",
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